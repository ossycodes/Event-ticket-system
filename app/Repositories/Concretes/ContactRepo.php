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
}