<?php

namespace App\Services\C;

class C
{
    public function __construct(public string $apiKey)
    {
    }

    public function send($message, $mobile)
    {
        return true;
    }
}
