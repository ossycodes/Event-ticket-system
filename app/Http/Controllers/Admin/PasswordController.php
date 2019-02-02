<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support \{
    Facades\Log,
        Facades\Hash
}; //php7 grouping use statements

use App\Repositories\Contracts\UserRepoInterface;


class PasswordController extends \App\Http\Controllers\Controller
{
    protected $userRepo;

    public function __construct(UserRepoInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        //return view
        return view('admin.password.index');
    }

    public function update(Request $request)
    {
        $this->validateRequest($request);

        //verify if password matches
        $data = $this->verifyPassword($request);

        if ($data) {
            return redirect('system-admin/admin/change-password')->with('success', 'Password updated successfully');
        } else {
            return redirect('system-admin/admin/change-password')->with('error', 'Incorrect password');
        }

    }

    public function verifyPassword($request)
    {
        $hashedPassowrd = $this->userRepo->getUserPassword();
        if (Hash::check($request->old_password, $hashedPassowrd)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateRequest($request)
    {
        return
            Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ])->validate();
    }
}
