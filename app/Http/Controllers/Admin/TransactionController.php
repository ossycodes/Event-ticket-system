<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    //used invoke since i have only one method in this class
    public function __invoke() {
        $noOfTransactions = Transaction::count();
        $allTransactions = Transaction::with('user')->get();
        return view('admin.transactions.index', compact('allTransactions', 'noOfTransactions'));
    }
}
