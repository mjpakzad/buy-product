<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public $collects = ProductResource::class;

    public function with(Request $request)
    {
        return [
            'meta' => [],
            'server_time' => now(),
        ];
    }
}
