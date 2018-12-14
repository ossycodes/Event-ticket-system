<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\TransactionRepoInterface;
use App\Events\TicketPurchased;

class PaymentController extends Controller
{
    /**
     * Issue Secret Key from your Paystack Dashboard
     * @var string
     */
    protected $secretKey;
    protected $transactionRepo;

    public function __construct(TransactionRepoInterface $transactionRepo)
    {
        $this->transactionRepo = $transactionRepo;
    }

    public function genTranxRef()
    {
        return $this->getHashedToken(25);
    }

    private static function getPool($type = 'alnum')
    {
        switch ($type) {
            case 'alnum':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'hexdec':
                $pool = '0123456789abcdef';
                break;
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'nozero':
                $pool = '123456789';
                break;
            case 'distinct':
                $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
                break;
            default:
                $pool = (string)$type;
                break;
        }
        return $pool;
    }
    /**
     * Generate a random secure crypt figure
     * @param  integer $min
     * @param  integer $max
     * @return integer
     */
    public static function secureCrypt($min, $max)
    {
        $range = $max - $min;
        if ($range < 0) {
            return $min; // not so random...
        }
        $log = log($range, 2);
        $bytes = (int)($log / 8) + 1; // length in bytes
        $bits = (int)$log + 1; // length in bits
        $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }
    /**
     * Finally, generate a hashed token
     * @param  integer $length
     * @return string
     */
    public static function getHashedToken($length = 25)
    {
        $token = "";
        $max = strlen(static::getPool());
        for ($i = 0; $i < $length; $i++) {
            $token .= static::getPool()[static::secureCrypt(0, $max)];
        }
        return $token;
    }

    public function redirectToProvider(Request $request)
    {

        try {
            $totalAmount = $request->amount * $request->qty * 100;
        } catch (\ErrorException $e) {
            Log::error($e->getMessage());
            return back()->with('trn_error', 'You can only book tickets that have a price provided.');
        }

        $initializePayment = 'https://api.paystack.co/transaction/initialize';
        $authBearer = 'Bearer ' . $this->setKey();

        try {

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
            $authorizationUrl = $response->data->authorization_url;

        } catch (\ErrorException $e) {
            Log::error($e->getMessage());
            return back()->with('trn_error', 'Unable to connect to service provider, please try again later.');
        }

        return redirect()->away($authorizationUrl);
    }


    public function handleGatewayCallback(Request $request)
    {

        $transactionRef = request()->query('trxref');

        $verifyPayment = 'https://api.paystack.co/transaction/verify/' . $transactionRef;
        $response = Curl::to($verifyPayment)
            ->withHeader('Authorization: Bearer ' . $this->SetKey())
            ->get();

        $response = json_decode($response);

        if ($response->status === true) {

            $this->transactionRepo->storeTransaction($response, Auth::user()->id);

            event(new TicketPurchased($response, Auth::user()));

            return redirect()->route('user.transaction')->with('success', 'Event Booked Successfully');

        } else {

            return redirect()->route('user.transaction')->with('error', 'Transaction failed, please try again later.');

        }
    }

    public function setKey()
    {
        $key = config('paystack.paystack_secret_key');
        return $key;
    }

}
