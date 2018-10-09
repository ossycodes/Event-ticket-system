<?php

namespace App\Http\Controllers\user;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index() {
        //return "all transactions show here";
        $transactions = Transaction::where('user_id', '=', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('users.transaction.index', compact('transactions'));
    }


}
