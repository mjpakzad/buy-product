<?php

namespace App\Models;

use App\Enums\TransactionGateway;
use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'gateway',
        'amount',
        'status',
    ];

    protected $casts = [
        'gateway' => TransactionGateway::class,
        'status' => TransactionStatus::class,
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
