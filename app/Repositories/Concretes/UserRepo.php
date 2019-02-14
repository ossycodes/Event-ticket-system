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

    public function getUsersOnline()
    {
        return User::where('online', 1)->get();
    }

    public function getUsersInDescendingOrder()
    {
        return User::where('role', 'user')->Orderby('created_at', 'asc')->get();
    }

    public function getAllUsersPlusAdmin()
    {
        return User::all();
    }

    public function deleteUser(int $id)
    {
        return User::destroy($id);
    }

    public function getUserViaEmail($userEmail)
    {
        return User::where('email', $user->getEmail())->first();
    }

    public function updatePassword($newPassword)
    {

        return Auth::User()->update([
            'password' => \Illuminate\Support\Facades\Hash::make($newPassword)
        ]);
    }

    public function updateUserName(\Illuminate\Http\Request $request)
    {
        return Auth::user()->update([
            'name' => $request->name
        ]);
    }

    public function updateUserProfile(\Illuminate\Http\Request $request)
    {
        return Auth::User()->profile()->update([
            'gender' => $request->gender,
            'phonenumber' => $request->phonenumber,
            'education' => $request->education,
            'skills' => $request->skills,
            'location' => $request->location,
        ]);
    }

    public function findUser(int $id)
    {
        return User::findOrFail($id);
    }

    public function getUserPassword()
    {
        return Auth::user()->password;
    }

    public function setUserProfileToDefault(int $userId)
    {
        return User::find($userId)->profile()->create([
            'gender' => '',
            'phonenumber' => '',
            'education' => '',
            'skills' => '',
            'location' => '',
        ]);
    }

    public function putUserOnline(int $userId)
    {
        return User::find($userId)->update([
            'online' => 1
        ]);
    }

    public function putUserOfline(int $userId)
    {
        return User::find($userId)->update([
            'online' => 0
        ]);
    }
}