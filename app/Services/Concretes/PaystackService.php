<?php

namespace App\Services\Concretes;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;
use App\Services\Contracts\PaymentInterface;


class PaystackService implements PaymentInterface
{
    use generateTransactionReference;

    const KOBO = 100;
    const INITIALIZEPAYMENTURL = 'https://api.paystack.co/transaction/initialize';
    const VERIFYPAYMENTURL = 'https://api.paystack.co/transaction/verify/';

    public function initalizePayment(Request $request)
    {
        $initializePayment = SELF::INITIALIZEPAYMENTURL;
        $totalAmount = $request->amount * $request->qty * SELF::KOBO;

        $response = Curl::to($initializePayment)
            ->withData([
                'reference' => $this->genTranxRef(),
                'amount' => intval($totalAmount),
                'email' => Auth::user()->email,
                'metadata' => $request->metadata,
            ])
            ->withHeader('Authorization: Bearer ' . $this->SetKey())
            ->asJson()
            ->post();

        $response = json_decode(json_encode($response));
        return $response->data->authorization_url;

    }

    public function verifyPayment()
    {
        $transactionRef = request()->query('trxref');

        $verifyPayment = SELF::VERIFYPAYMENTURL . $transactionRef;
        $response = Curl::to($verifyPayment)
            ->withHeader('Authorization: Bearer ' . $this->SetKey())
            ->get();

        $response = json_decode($response);

        if ($response->status === true && $response->data->status === "success") {
            return $response;
        } else {
            return false;
        }

    }
}