<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NotEnoughStockAvailableException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->error(['message' => 'There is not enough product exists in our warehouse!'], [], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
