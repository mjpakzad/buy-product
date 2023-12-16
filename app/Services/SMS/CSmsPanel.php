<?php

namespace App\Services\SMS;

use App\Services\C\C as SMSPanel;
use Illuminate\Support\Facades\Log;

class CSmsPanel extends BaseSmsHandler
{
    public function sendSms($message, $mobile)
    {
        try {
            $a = new SMSPanel(config('buy_product.a_api_key'));
            $a->send($message, $mobile);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send SMS via B SMS Panel: ' . $e->getMessage());

            return parent::sendSms($message, $phoneNumber);
        }

        return parent::sendSms($message, $phoneNumber);
    }
}
