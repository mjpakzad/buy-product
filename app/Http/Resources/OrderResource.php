<?php

namespace App\Http\Resources;

use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->whenLoaded('user', new UserResource($this->user)),
            'content' => $this->content,
            'status' => OrderStatus::flip($this->status->value),
            'total_amount' => $this->amount,
            'transactions' => $this->whenLoaded('transactions', new TransactionCollection($this->transactions)),
            'products' => $this->whenLoaded('products', new ProductCollection($this->products))
        ];
    }
}
