<?php

namespace App\Services\SMS;

use App\Services\A\A as SMSPanel;
use Illuminate\Support\Facades\Log;

class ASmsPanel extends BaseSmsHandler
{
    public function sendSms($message, $mobile)
    {
        try {
            $a = new SMSPanel(config('buy_product.a_api_key'));
            $a->send($message, $mobile);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send SMS via A SMS Panel: ' . $e->getMessage());

            return parent::sendSms($message, $phoneNumber);
        }

        return parent::sendSms($message, $phoneNumber);
    }
}
