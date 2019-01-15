<?php

namespace App\Repositories\Contracts;

interface UserRepoInterface
{
    public function getTotalUsers();

    public function getUser();

    public function getUserProfile();

    public function getUsersOnline();

    public function getUsersInDescendingOrder();

    public function getAllUsersPlusAdmin();

    public function deleteUser(int $id);

    public function getUserViaEmail($userEmail);

    public function updatePassword($newPassword);
}