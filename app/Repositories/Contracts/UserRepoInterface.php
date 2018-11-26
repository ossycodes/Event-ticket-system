<?php

namespace App\Repositories\Contracts;

interface UserRepoInterface
{
    public function getTotalUsers();

    public function getUser();
}