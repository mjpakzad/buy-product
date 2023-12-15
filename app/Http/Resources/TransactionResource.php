<?php

namespace App\Http\Resources;

use App\Enums\TransactionGateway;
use App\Enums\TransactionStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'gateway' => TransactionGateway::flip($this->gateway->value),
            'amount' => $this->amount,
            'status' => TransactionStatus::flip($this->status->value),
        ];
    }
}
