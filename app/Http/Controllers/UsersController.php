<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
{
    public function jsonResponse($user){
        return response()->json($user);
    }

    public function userDetails(){
        $userDetails = Auth::user();
        return $this->jsonResponse($userDetails);
        //echo $userDetails->id; die;
        //echo $userDetails->email; die;
        //echo $userDetails->password; die;
        //echo $userDetails->created_at;
        //echo $userDetails->updated_at;
    }
    public function AnotherWayToGetUserdetails(Request $request){
        echo $request->user();
        //echo $request->user()->id; die;
        //echo $request->user()->email; die;
        //echo $request->user()->password; die;
        //echo $request->user()->created_at;
        //echo $request->user()->updated_at;
    }

    public function checkIfUserIsAuthenticated(){
        if(Auth::check()){
           echo "Authenticted";
        }else{
            echo "Not Authenticated oh";
        }
    }

    public function checkIfUserPasswordMatches(Request $request){
        $hashedPassword = $request->user()->password;
        $plaintext = 'xxxxxx';
        if(Hash::check($plaintext, $hashedPassword)) {
            echo "password match"; die;
        }
        echo "Password doesnt match";
    }

    /*
    public function arrayDetails(){
        $user = Auth::user();
        $array = array_except($user, ['created_at', 'updated_at']);
        echo $array; die;
    }
    */

    /*
    public function arrayDetails(){
        $user = Auth::user();
        $array = array_first($user);
        echo $array; die;
    }
    */

    /*
    public function arrayDetails(){
        $user = Auth::user();
        $array = array_flatten($user);
        return $this->jsonResponse($array);    
    }
    */
    
    /*
    public function arrayDetails(){
        $user = Auth::user();
        $user = ['name' => 'ossy', 'email' => 'chris'];
        $array = array_only($user, 'email');
        //echo $array; die;
        return $this->jsonResponse($array);
    }
    */

    public function arrayDetails(){
        $user = Auth::user();
        $array = array_pull($user, 'updated_at');
        //return $this->jsonResponse($array);
        return Auth::user();
    }
    
    public function getApp(){
         $container = app('controller.php');
         return $this->jsonResponse($container);
    }

    public function errorpage(){
        return view('404');
    }
}
