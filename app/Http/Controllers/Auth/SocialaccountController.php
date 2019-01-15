<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Socialaccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\Contracts\UserRepoInterface;
use App\Repositories\Contracts\SocialaccountRepoInterface;

class SocialaccountController extends Controller
{
    protected $socialAccount;
    protected $userRepo;

    public function __construct(SocialaccountRepoInterface $socialAccount, UserRepoInterface $userRepo)
    {
        $this->socialAccount = $socialAccount;    
        $this->userRepo = $userRepo;
    }

    public function redirectToProvider($provider)
    {
        try{
            return Socialite::driver($provider)->redirect();
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            return back()->with('error', "Error connecting to {$provider} service");
        }
        
    }
    public function handleProviderCallback($provider)

    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', $e);
        }
        $authUser = $this->findOrCreateUser($user, $provider);
        $this->putUserOnline($user);
        Auth::login($authUser, true);
        return redirect('/home');
    }

    public function findOrCreateUser($user, $provider)
    {
        $account = $socialAccount->getUserSocialAccount($provider, $user->getId());
        // $account = Socialaccount::where('provider_name', $provider)->where('provider_id', $user->getId())->first();
        if ($account) {
            return $account->user;
        } else {
            // $authUser = User::where('email', $user->getEmail())->first();
            $authUser = $userRepo->getUserViaEmail($user->getEmail());
            if (!$authUser) {
                $authUser = User::create([
                    'email' => $user->getEmail(),
                    'name' => $user->getName(),
                    'password' => ''
                ]);

                $this->updateUserProfile($authUser->id);

            }
            $authUser->socialAccounts()->create([
                'provider_id' => $user->getId(),
                'provider_name' => $provider,
            ]);
            return $authUser;
        }
    }

    public function updateUserProfile(int $id)
    {

        $user = User::find($id)->profile()->create([
            'gender' => '',
            'phonenumber' => '',
            'education' => '',
            'skills' => '',
            'location' => '',
        ]);

        $this->putUserOnline($user);
    }

    public function putUserOnline($user)
    {
        if (!Session::has('clue')) {
            User::where('email', $user->email)->update([
                'online' => '1',
            ]);
        } else {
            Session(['clue', $user->email]);
            User::where('email', $user->email)->update([
                'online' => '1',
            ]);
        }
    }
}
