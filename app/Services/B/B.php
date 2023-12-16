<?php

namespace App\Services\B;

class B
{
    public function __construct(public string $apiKey)
    {
    }

    public function send($message, $mobile)
    {
        return true;
    }
}
