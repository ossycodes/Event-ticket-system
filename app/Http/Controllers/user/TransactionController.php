<?php

namespace App\Http\Controllers\user;

use App \{
    Transaction,
        Http\Controllers\Controller
}; //php7 grouping use statements

use Illuminate \{
    Http\Request,
        Support\Facades\Auth
}; //php7 grouping use statements

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
