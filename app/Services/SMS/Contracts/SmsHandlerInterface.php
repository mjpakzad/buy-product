<?php

namespace App\Services\SMS\Contracts;

interface SmsHandlerInterface
{
    public function sendSms($message, $mobile);
    public function setNext(SmsHandlerInterface $handler);
}
