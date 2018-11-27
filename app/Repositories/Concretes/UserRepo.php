<?php

namespace App\Repositories\Concretes;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\UserRepoInterface;


class UserRepo implements UserRepoInterface
{
    public function getTotalUsers()
    {
        return User::where('role', 'user')->count();
    }

    public function getUser()
    {
        return User::where('role', 'user')->get();
    }

    public function getUserProfile()
    {
        return Auth::user()->profile;
    }

}