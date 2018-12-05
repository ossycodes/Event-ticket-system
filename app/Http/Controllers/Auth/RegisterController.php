<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Mail\registeredUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
       
        //send welcome mail to user
        Mail::to($user)->send(new registeredUser($user));
       
        //update user's profile
        $this->updateProfile($user);
            
        return $user;

    }

    public function updateProfile($user) {

        User::find($user->id)->profile()->create([
            'gender' => '',
            'phonenumber' => '',
            'education' => '',
            'skills' => '',
            'location' => '',
        ]);
        
        if(!Session::has('clue')) {
            User::where('email', $user->email)->update([
                'online' => '1',
            ]);
            $request->session()->get('clue');
        } else {
            Session(['clue', $user->email]);
            User::where('email', $user->email)->update([
                'online' => '1',
            ]);
        }
    
    }

    public function sendRegisteredUserMail($user) {
        Mail::to($user)->send(new registeredUser($user));
    }
}
