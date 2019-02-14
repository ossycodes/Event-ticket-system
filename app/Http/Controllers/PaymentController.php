<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\TransactionRepoInterface;
use App\Events\TicketPurchased;
// use App\Services\Concretes\PaystackService;
use App\Services\Contracts\PaymentInterface;

class PaymentController extends Controller
{
    protected $transactionRepo;
    protected $paystackService;


    /**
     * PaymentController constructor.
     * @param TransactionRepoInterface $transactionRepo
     * @param PaymentInterface $paystackService
     */
    public function __construct(TransactionRepoInterface $transactionRepo, PaymentInterface $paystackService)
    {
        $this->transactionRepo = $transactionRepo;
        $this->paystackService = $paystackService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGatewayCallback(Request $request)
    {
        $response = $this->paystackService->verifyPayment();

        if ($response) {
            try {
                $this->transactionRepo->storeTransaction($response, Auth::user()->id);
            } catch (\ErrorException $e) {
                Log::error($e->getMessage());
                return back()->with('trn_error', 'Unable to connect to service provider, please try again later.');
            }
            //send a ticketPurchased email to the user
            event(new TicketPurchased($response, Auth::user()));
            return redirect()->route('user.transaction')->with('success', 'Event Booked Successfully');

        }
        return redirect()->route('user.transaction')->with('error', 'Transaction failed, please try again later.');

    }


}
