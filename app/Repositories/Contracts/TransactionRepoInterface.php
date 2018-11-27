<?php

namespace App\Repositories\Contracts;

interface TransactionRepoInterface
{
    public function getTotalTransaction();

    public function getTransactionDescendingOrder(int $id);
}