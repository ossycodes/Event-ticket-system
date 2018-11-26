<?php

namespace App\Http\Controllers\user;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //use invoke since a single method is present in the class
    public function __invoke()
    {
        $transactions = Transaction::where('user_id', '=', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('users.transaction.index', compact('transactions'));
    }


}
