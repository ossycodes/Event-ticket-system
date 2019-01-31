<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\TransactionRepoInterface;
use App\Events\TicketPurchased;
use App\Services\Concretes\PaystackService;

class PaymentController extends Controller
{
    protected $transactionRepo;
    protected $paystackService;

    public function __construct(TransactionRepoInterface $transactionRepo, PaystackService $paystackService)
    {
        $this->transactionRepo = $transactionRepo;
        $this->paystackService = $paystackService;
    }

    public function redirectToProvider(Request $request)
    {
        try {
            $authorizationUrl = $this->paystackService->initalizePayment($request);
        } catch (\ErrorException $e) {
            Log::error($e->getMessage());
            return back()->with('trn_error', 'Unable to connect to service provider, please try again later.');
        }
        return redirect()->away($authorizationUrl);
    }


    public function handleGatewayCallback(Request $request)
    {
        $response = $this->paystackService->verifyPayment();

        if ($response) {
             //store the user transaction details in database
            $this->transactionRepo->storeTransaction($response, Auth::user()->id);

            //send a ticketPurchased email to the user
            event(new TicketPurchased($response, Auth::user()));

            return redirect()->route('user.transaction')->with('success', 'Event Booked Successfully');

        }
            return redirect()->route('user.transaction')->with('error', 'Transaction failed, please try again later.');

    }

}
