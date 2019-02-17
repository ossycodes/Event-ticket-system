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

    public function createSocialAccountForUser($authUser, $user, $provider)
    {
         $authUser->socialAccounts()->create([
            'provider_id' => $user->getId(),
            'provider_name' => $provider,
        ]);
    }
}