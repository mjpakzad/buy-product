<?php

namespace App\Http\Controllers\API\V1;

use App\Enums\OrderStatus;
use App\Enums\TransactionGateway;
use App\Enums\TransactionStatus;
use App\Exceptions\AnotherPurchaseInProgressException;
use App\Exceptions\InsufficientCreditException;
use App\Exceptions\NotEnoughStockAvailableException;
use App\Exceptions\ProductAlreadyReservedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderCollection;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class OrderController extends Controller
{
    public $userRepository;
    public $transactionRepository;

    public $productRepository;

    public function __construct(public OrderRepositoryInterface $orderRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $orders = $this->orderRepository->list(['user_id' => $user->id]);
        return OrderCollection::make($orders);
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(OrderRequest $request)
    {
        $this->userRepository = resolve(UserRepositoryInterface::class);
        $this->transactionRepository = resolve(TransactionRepositoryInterface::class);
        $this->productRepository = resolve(ProductRepositoryInterface::class);

        $product = $this->productRepository->findBySlug($request->validated('product_slug'));

        $user = auth()->user();
        $PurchaseLockKey = "user:{$user->id}:purchase-locked";
        throw_unless(Redis::set($PurchaseLockKey, true, 'NX'), AnotherPurchaseInProgressException::class);

        $quantity = 1;
        $amount = $product->price;
        $totalAmount = $amount * $quantity;
        $productsData = [
            $product->id => [
                'quantity' => $quantity,
                'amount' => $amount,
                'total_amount' => $totalAmount,
            ],
        ];
        $orderData = [
            'user_id' => $user->id,
            'content' => $request->validated('content'),
            'status' => OrderStatus::PAYMENT_PENDING->value,
            'total_amount' => $totalAmount,
        ];

        throw_unless($this->productRepository->hasStock($product, $quantity), NotEnoughStockAvailableException::class);
        throw_unless($this->userRepository->hasCredit($user, $totalAmount), InsufficientCreditException::class);
        throw_if(Redis::get("product:{$product->id}:reserved"), ProductAlreadyReservedException::class);

        try {
            DB::beginTransaction();

            Redis::set("product:{$product->id}:reserved", true);

            $user = $this->userRepository->reduceCredit($user, $totalAmount);

            $order = $this->orderRepository->create($orderData);

            $this->orderRepository->addProducts($order, $productsData);
            $this->productRepository->reduceQuantity($product, $quantity);

            $transactionData = [
                'order_id' => $order->id,
                'gateway' => TransactionGateway::CREDIT->value,
                'amount' => $order->total_amount,
                'status' => TransactionStatus::PAID,
            ];
            $this->transactionRepository->create($transactionData);
            $this->orderRepository->orderPaid($order);

            DB::commit();

            Redis::del("product:{$product->id}:reserved");

            return response()->success(['message' => 'Your order has been successfully paid!']);
        } catch (\Exception $e) {
            DB::rollBack();

            Redis::del($PurchaseLockKey);

            return response()->error(['message' => $e->getMessage()]);
        } finally {
            Redis::del($PurchaseLockKey);
        }
    }
}
