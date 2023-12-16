<?php

namespace App\Services\SMS;

use App\Services\SMS\Contracts\SmsHandlerInterface;
use Illuminate\Support\Facades\Log;

abstract class BaseSmsHandler implements SmsHandlerInterface
{
    protected $nextHandler;

    /**
     * @param SmsHandlerInterface $handler
     * @return SmsHandlerInterface
     */
    public function setNext(SmsHandlerInterface $handler)
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    /**
     * @param $message
     * @param $mobile
     * @return void
     */
    public function sendSms($message, $mobile)
    {
        if ($this->nextHandler) {
            return $this->nextHandler->sendSms($message, $mobile);
        }

        Log::error('No SMS handler can send the message!');
    }
}
