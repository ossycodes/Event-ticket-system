<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TransactionRepoInterface;

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
        $noOfTransactions = $this->transactionRepo->getTotalTransaction();
        $allTransactions = $this->transactionRepo->getUsersTransactions();
        return view('admin.transactions.index', compact('allTransactions', 'noOfTransactions'));
    }
}
