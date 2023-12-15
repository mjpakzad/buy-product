<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductAlreadyReservedException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->error(['message' => 'Product is already reserved.'], [], Response::HTTP_LOCKED);
    }
}
