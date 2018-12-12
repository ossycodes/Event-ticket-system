<?php

namespace App\Repositories\Concretes;

use App\Newsletter;
use App\Repositories\Contracts\NewsletterRepoInterface;


class NewsletterRepo implements NewsletterRepoInterface
{
    public function getTotalSubscribers()
    {
        return Newsletter::count();
    }

    public function getSubscribers()
    {
        return Newsletter::all();
    }

    public function storeNewsletterSubscriber(Array $data)
    {
        Newsletter::create($data);
    }
}