<?php

namespace App\Repositories\Contracts;

interface SocialaccountRepoInterface
{
    public function getUserSocialAccount($provider, $userId);
}