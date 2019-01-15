<?php

namespace App\Http\Controllers\User;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades \{
        Hash,
        Auth,
        Log
};
use App\Repositories\Contracts\UserRepoInterface; //php7 grouping use statements


class PasswordController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepoInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return view('users.password.index');
    }

    public function update(Request $request)
    {
        //validate the incoming request
        $this->validateRequest($request);

        try {
            if (Hash::check($request->old_password, Auth::user()->password)) {
                $this->userRepo->updatePassword($request->new_password);
                log::info('password updated succcessfully');
                return back()->with('success', 'Password changed successfully');
            }

        } catch (\Exception $e) {
            Log::info($e->getMessage());
            //something goes wrong
            return back()->with('error', 'Something went wrong');
        }
        
        //something went wrong
        Log::info('something went wrong');
        return back()->with('error', 'Old password is incorrect');
    }

    public function validateRequest(Request $request)
    {
        //custom error messages
        $msg = [
            'old_password.required' => 'Please provide your old password',
            'new_password.required' => 'Please provide your new password',
        ];

        return Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ], $msg)->validate();
    }
}
