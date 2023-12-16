<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SmsHandlerCantSendException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->error(['message' => 'No SMS handler can send the message'], [], Response::HTTP_SERVICE_UNAVAILABLE);
    }
}
