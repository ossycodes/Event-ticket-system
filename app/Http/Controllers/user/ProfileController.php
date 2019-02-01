<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App \{
        Http\Controllers\Controller,
        Http\Requests\updateProfile
}; //php7 grouping use statements

use App\Repositories\Contracts\UserRepoInterface;


class ProfileController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepoInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //please refer to userprofileindexcomposer for data passed to this views
        return view('users.profile.index');
    }

    public function update(updateProfile $request, $id)
    {
        //if the request has a name as part of the request;
        if ($request->has('name')) {
            //update user  name
            $this->updateName($request);
            //update user profile
            $this->updateProfile($request);
            //redirect the user back with flash seession success message
            return back()->with('success', 'Profile updated successfully');
        }
        return back()->with('error', 'Something went wrong');
    }


    public function updateName(Request $request)
    {
        $this->userRepo->updateUserName($request);
    }

    public function updateProfile(Request $request)
    {
        $this->userRepo->updateUserProfile($request);
    }

    public function deleteAccount(Request $request, $id)
    {
        //delete user
        try {
            $this->userRepo->deleteUser($id);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong');
        }

        //destroy user session
        $request->session()->flush();

        //redirect back to home
        return redirect()->route('login')->with('success', 'Account deleted successfully');
    }
}
