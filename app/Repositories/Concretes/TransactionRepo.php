<?php

namespace App\Repositories\Concretes;

use App\Transaction;
use App\Repositories\Contracts\TransactionRepoInterface;


class TransactionRepo implements TransactionRepoInterface
{
    public function getTotalTransaction()
    {
        return Transaction::count(); 
    }
}