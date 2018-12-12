<?php

namespace App\Repositories\Contracts;

interface ContactRepoInterface
{
    public function getTotalContacts();

    public function getLatestContactusMessage();

    public function getContactusMessages();

    public function storeContactusMessage(array $data);
}