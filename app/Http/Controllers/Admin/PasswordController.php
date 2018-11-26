<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use App\User;

class PasswordController extends Controller
{
    public function index()
    {
        //logging event
        Log::info('returned change-password form for user with email and name:' . ' ' . Auth::user()->email . ' ' . 'and' . ' ' . Auth::user()->name . ' ' . 'respectively');
        //return view
        return view('admin.password.index');
    }

    public function update(Request $request)
    {
        
        //validate the incoming request
        Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ])->validate();

        //verify if password matches
        $data = $this->verifyPassword($request);

        if ($data) {

            Auth::user()->update([
                'password' => bcrypt($request->new_password)
            ]);
             
            //logging info
            log::info('User with email:' . Auth::user()->email . ' ' . 'changed his/her old password to a new password ');
            //redirect with flash success mesage
            return redirect('system-admin/admin/change-password')->with('success', 'Password updated successfully');

        } else {

            //logging error
            log::error('failed to change user with email:' . Auth::user()->email . ' ' . 'password, due to incorrect password provided');
            //return flash error message to user
            return redirect('system-admin/admin/change-password')->with('error', 'Incorrect password');
        }

    }

    public function verifyPassword($request)
    {
        $hashedPassowrd = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassowrd)) {
            return true;
        } else {
            return false;
        }
    }
}
