<?php

namespace App\Repositories\Concretes;

use App\Contact;
use App\Repositories\Contracts\ContactRepoInterface;


class ContactRepo implements ContactRepoInterface
{
    public function getTotalContacts()
    {
        return Contact::all()->count();
    }

    public function getLatestContactusMessage()
    {
        return Contact::latest()->first();
    }

    public function getContactusMessages()
    {
        return Contact::all();
    }

    public function storeContactusMessage(array $data) {
        return Contact::create($data);
    }

    public function deleteContactusMessage(int $id) {
        return Contact::destroy($id);
    }
}