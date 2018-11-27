<?php

namespace App\Repositories\Contracts;

interface TransactionRepoInterface
{
    public function getTotalTransaction();

    public function getTransactionDescendingOrder(int $id);

    public function getLatestTicketPurchasedByUser(int $id);

    public function getTotalTicketsPurchasedByUser(int $id);

    public function getUsersTransactions();
}