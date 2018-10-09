<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Issue Secret Key from your Paystack Dashboard
     * @var string
     */
    protected $secretKey;

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
                $pool = (string) $type;
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
        $log    = log($range, 2);
        $bytes  = (int) ($log / 8) + 1; // length in bytes
        $bits   = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
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
        $max   = strlen(static::getPool());
        for ($i = 0; $i < $length; $i++) {
            $token .= static::getPool()[static::secureCrypt(0, $max)];
        }
        return $token;
    }
    public function redirectToProvider(Request $request) {
        //dd($request->all());

        //TDOD create a method that handles all the totalPayment
        $totalAmount = $request->amount * $request->qty * 100;
        $initializePayment = 'https://api.paystack.co/transaction/initialize';
        $authBearer = 'Bearer '. $this->setKey();

        try{

            $response = Curl::to($initializePayment)
                ->withData([
                    'reference' => $this->genTranxRef(),
                    'amount' => intval($totalAmount),//this should come from the modified request
                    'email'=> Auth::user()->email, //this should come form request
                    'metadata' => $request->metadata,
                ])
                ->withHeader('Authorization: Bearer '.$this->SetKey())
                ->asJson()
                ->post();
                //return response()->json($response);
        
            $response = json_decode(json_encode($response));
            $authorizationUrl =  $response->data->authorization_url;

        } catch(\ErrorException $e) {
            return back()->with('trn_error', 'Unable to connect to service provider, please try again later.');
        }
        
        return redirect()->away($authorizationUrl);
    }

    
    public function handleGatewayCallback(Request $request) {
        
        
        $transactionRef = request()->query('trxref');
        
        //make a call to verify
        $verifyPayment = 'https://api.paystack.co/transaction/verify/'.$transactionRef;
        //store secret in env file    
        $response = Curl::to($verifyPayment)
        ->withHeader('Authorization: Bearer '.$this->SetKey())
        ->get();
        //return $response;
        
         $response = json_decode($response);
        //return response()->json($response);
        
        if($response->status === true) {

            //TODO store in response in transaction database
            Transaction::create([
                'status' => $response->data->status,
                'user_id' => Auth::user()->id,
                'reference_id' => $response->data->reference,
                'tran_id' => $response->data->id,
                'amount' => $response->data->amount,
                'paid_through' => $response->data->channel,
                'event_name' => $response->data->metadata->custom_fields[0]->event_name,
                //'qty' => $request->qty,
            ]);

            return redirect()->route('user.transaction')->with('success', 'Event Booked Successfully');

            //dd(response()->json($response));

        }else {

             dd(response()->json($response)); 
             return redirect()->route('user.transaction')->with('error', 'Transaction failed, please try again later.');   

        }
    }

    public function setKey() {
          return env('PAYSTACK_SECRET_KEY');
    }

}
