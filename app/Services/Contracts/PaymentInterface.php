<?php

namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface PaymentInterface 
{
    public function initalizePayment(Request $request);

    // public function verifyPayment();
}