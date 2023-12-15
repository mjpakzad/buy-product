<?php

namespace App\Http\Resources;

use App\Enums\ProductStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'heading' => $this->heading,
            'slug' => $this->slug,
            'content' => $this->content,
            'stock' => $this->stock,
            'price' => $this->price,
            'status' => ProductStatus::flip($this->status->value),
        ];
    }
}
