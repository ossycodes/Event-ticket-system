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

    /**
     * TransactionController constructor.
     * @param TransactionRepoInterface $transactionRepo
     */
    public function __construct(TransactionRepoInterface $transactionRepo)
    {
        $this->transactionRepo = $transactionRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        $allTransactions = $this->transactionRepo->getUsersTransactions();
        return view('admin.transactions.index', compact('allTransactions'));
    }
}
