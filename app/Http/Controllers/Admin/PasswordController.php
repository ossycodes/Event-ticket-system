<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use App\User;

class PasswordController extends Controller
{
    public function index(){
    
        return view('admin.password.index');
    }

    public function update(Request $request){
        
        //validate the incoming request
        Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ])->validate();
        
        //call the verifyPassword function
        $data = $this->verifyPassword($request);
        
        if($data){
            //return response()->json($data);
            Auth::user()->update([
                'password' => bcrypt($request->new_password)
            ]);
         
            return redirect('system-admin/admin/change-password')->with('success', 'Password updated successfully');
            
        }else{
            return redirect('system-admin/admin/change-password')->with('error', 'Incorrect password');
        }
             
    }

    public function verifyPassword($request){
        $hashedPassowrd = Auth::user()->password;
        if(Hash::check($request->old_password, $hashedPassowrd)){
            return true;
        }else{
            return false;
        }
    }
}
