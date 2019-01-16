<?php

namespace App\Repositories\Concretes;

use App\Socialaccount;
use App\Repositories\Contracts\SocialaccountRepoInterface;


class SocialaccountRepo implements SocialaccountRepoInterface
{
    public function getUserSocialAccount($provider, $userId)
    {
        return Socialaccount::where('provider_name', $provider)->where('provider_id', $userId)->first();
    }
}