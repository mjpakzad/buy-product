<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InsufficientCreditException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->error(['message' => 'Your credit is lower than the product price!'], [], Response::HTTP_FORBIDDEN);
    }
}
