<?php

namespace App\Services\A;

class A
{
    public function __construct(public string $apiKey)
    {
    }

    public function send($message, $mobile)
    {
        return true;
    }
}
