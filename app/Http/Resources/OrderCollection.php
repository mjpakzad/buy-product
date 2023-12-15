<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    public $collects = OrderResource::class;

    public function with(Request $request)
    {
        return [
            'meta' => [],
            'server_time' => now(),
        ];
    }
}
