<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Validator;

class PasswordController extends Controller
{
    public function index(){
        return view('users.password.index');
    }

    public function update(Request $request) {
        //validate the incoming request
        $this->validateRequest($request);

        try{
                if(Hash::check($request->old_password, Auth::user()->password)){
                    log::info('password updated succcessfully');
                    Auth::User()->update([
                        'password' => bcrypt($request->new_password)
                    ]);
                    return back()->with('success', 'Password changed successfully');
              }

            }catch(\Exception $e) {
                    Log::info($e->getMessage());
                    //something goes wrong
                    return back()->with('error', 'Something went wrong');
            }
            //something went wrong
            Log::info('something went wrong');
            return back()->with('error', 'Something went wrong');
    }
 
    public function validateRequest(Request $request) {
        
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
