<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AnotherPurchaseInProgressException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->error(['message' => 'Another purchase operation is in progress!'], [], Response::HTTP_FORBIDDEN);
    }
}
