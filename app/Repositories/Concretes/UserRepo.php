<?php

namespace App\Repositories\Concretes;

use App\User;
use App\Repositories\Contracts\UserRepoInterface;


class UserRepo implements UserRepoInterface
{
    public function getTotalUsers()
    {
        return User::where('role', 'user')->count();
    }
}