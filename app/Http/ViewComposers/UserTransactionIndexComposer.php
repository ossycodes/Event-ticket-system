<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\TransactionRepoInterface;

class UserTransactionIndexComposer
{
    protected $transactionRepo;

    public function __construct(TransactionRepoInterface $transactionRepo)
    {
        $this->transactionRepo = $transactionRepo;
    }

    public function compose(View $view)
    {
        $transactions = $this->transactionRepo->getTransactionDescendingOrder(Auth::id());
        $view->with(compact('transactions'));
    }
}