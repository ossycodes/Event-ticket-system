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

    public function getUsersTransactions()
    {
        return Transaction::with('user')->get();
    }

    public function storeTransaction(Object $data, int $id)
    {
        Transaction::create([
            'status' => $data->data->status,
            'user_id' => $id,
            'reference_id' => $data->data->reference,
            'tran_id' => $data->data->id,
            'amount' => $data->data->amount,
            'paid_through' => $data->data->channel,
            'event_name' => $data->data->metadata->custom_fields[0]->event_name,
        ]);
    }
}