<?php

namespace App\Services;

use App\Services\Concretes\PaystackService;


class PaymentProviderFactory
{
    public function make($paymentProvider)
    {
        dd($paymentProvider);
        
        switch($paymentProvider) {
            case 'paystack':
            return new PaystackService;
            break;

            //some other service providers goes in here
        }
    }
}