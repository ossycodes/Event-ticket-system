<?php

namespace App\Http\Controllers\user;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
//Real-time facade
use Facades\App\Repositories\Contracts\TransactionRepoInterface;

class TransactionController extends Controller
{
    //use invoke since a single method is present in the class
    public function __invoke()
    {
        //Real-time facade
        $transactions = TransactionRepoInterface::getTransactionDescendingOrder(Auth::user()->id);
        return view('users.transaction.index', compact('transactions'));
    }


}
