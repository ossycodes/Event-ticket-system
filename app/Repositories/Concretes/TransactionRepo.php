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

    public function getTransactionDescendingOrder(int $id)
    {
        return Transaction::where('user_id', '=', $id)->orderBy('id', 'DESC')->get();
    }

    public function getLatestTicketPurchasedByUser(int $id)
    {
        return Transaction::where([
            ['user_id', '=', $id],
            ['status', '=', 'success']
        ])->get();
    }

    public function getTotalTicketsPurchasedByUser(int $id)
    {
        return Transaction::where([
            ['user_id', '=', $id],
            ['status', '=', 'success']
        ])->count();
    }

    public function getUsersTransactions() {
        return Transaction::with('user')->get();
    }
}