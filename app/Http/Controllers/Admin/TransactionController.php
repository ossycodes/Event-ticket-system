<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index() {
        $noOfTransactions = Transaction::count();
        $allTransactions = Transaction::with('user')->get();
        return view('admin.transactions.index', compact('allTransactions', 'noOfTransactions'));
    }
}
