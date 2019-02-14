<?php

namespace App\Http\Controllers\Admin;

use Auth;

use App\Repositories\Contracts\UserRepoInterface;
use Illuminate \{
    Http\Request,
        Support\Facades\Log
}; //php7 grouping use statements



class ProfileController extends \App\Http\Controllers\Controller
{
    protected $eventRepo;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(UserRepoInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //please refer to adminprofileindexcomposer for data passed to this view
        return view('admin.profile.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
     * @return mixed
     */
    public function updateName(Request $request)
    {
        return $this->userRepo->updateUserName($request);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateProfile(Request $request)
    {
        return $this->userRepo->updateUserProfile($request);
    }
}
