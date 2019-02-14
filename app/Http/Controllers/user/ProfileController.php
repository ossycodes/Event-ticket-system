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

    /**
     * ProfileController constructor.
     * @param UserRepoInterface $userRepo
     */
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

    /**
     * @param updateProfile $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(updateProfile $request, $id)
    {
        if ($request->has('name')) {
            $this->updateName($request);
            $this->updateProfile($request);
            return back()->with('success', 'Profile updated successfully');
        }
        return back()->with('error', 'Something went wrong');
    }


    /**
     * @param Request $request
     */
    public function updateName(Request $request)
    {
        $this->userRepo->updateUserName($request);
    }

    /**
     * @param Request $request
     */
    public function updateProfile(Request $request)
    {
        $this->userRepo->updateUserProfile($request);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAccount(Request $request, $id)
    {
        try {
            $this->userRepo->deleteUser($id);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong');
        }

        return redirect()->route('login')->with('success', 'Account deleted successfully');
    }
}
