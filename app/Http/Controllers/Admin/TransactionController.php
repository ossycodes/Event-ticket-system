<?php

namespace App\Http\Controllers\Admin;

use App\{
    Transaction,
    Http\Controllers\Controller,
    Repositories\Contracts\TransactionRepoInterface
}; //php7 grouping use statements

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionRepo;

    public function __construct(TransactionRepoInterface $transactionRepo)
    {
        $this->transactionRepo = $transactionRepo;
    }
    //used invoke since i have only one method in this class
    public function __invoke()
    {
        $allTransactions = $this->transactionRepo->getUsersTransactions();
        return view('admin.transactions.index', compact('allTransactions'));
    }
}
