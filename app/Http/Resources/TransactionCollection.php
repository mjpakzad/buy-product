<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
{
    public $collects = TransactionResource::class;

    public function with(Request $request)
    {
        return [
            'meta' => [],
            'server_time' => now(),
        ];
    }
}
