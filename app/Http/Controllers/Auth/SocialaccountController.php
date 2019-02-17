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
use App\Listeners\PutUserOnline;

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
        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
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

        Auth::login($authUser, true);
        return redirect('/home');
    }

    public function findOrCreateUser($user, $provider)
    {
        $account = $this->socialAccount->getUserSocialAccount($provider, $user->getId());
        if ($account) {
            return $account->user;
        } else {
            $authUser = $this->userRepo->getUserViaEmail($user->getEmail());
            if (!$authUser) {
                $this->userRepo->createUser($user->getEmail(), $user->getName());
                //this should trigger the update user profile event
            }
            $authUser = $this->socialAccount->createSocialAccountForUser($authUser, $user->getId(), $provider);
            return $authUser;
        }
    }

    public function updateUserProfile(int $id)
    {
        $this->userRepo->setUserProfileToDefault($id);
    }

}
