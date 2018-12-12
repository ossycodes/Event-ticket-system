<?php

namespace App\Repositories\Contracts;

interface NewsletterRepoInterface
{
    public function getTotalSubscribers();

    public function storeNewsletterSubscriber(Array $data);
}