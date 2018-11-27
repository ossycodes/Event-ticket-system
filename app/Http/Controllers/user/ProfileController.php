<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Event;
use App\Profile;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\updateProfile;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\EventRepoInterface;
use App\Repositories\Contracts\TransactionRepoInterface;
use App\Repositories\Contracts\UserRepoInterface;

class ProfileController extends Controller
{
    protected $eventRepo;
    protected $transactionRepo;
    protected $userRepo;

    public function __construct(EventRepoInterface $eventRepo, TransactionRepoInterface $transactionRepo, UserRepoInterface $userRepo)
    {   
        $this->eventRepo = $eventRepo;
        $this->transactionRepo = $transactionRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventsuploaded = $this->eventRepo->getEventsUploadedByUser(Auth::user()->id);

        $noOfEventUploaded = $this->eventRepo->getTotalEventsUploadedByUser(Auth::user()->id);

        $latestEventTicketsPurchased = $this->transactionRepo->getLatestTicketPurchasedByUser(Auth::user()->id);

        $noOfEventTicketsPurchased = $this->transactionRepo->getTotalTicketsPurchasedByUser(Auth::user()->id);

        $profile = $this->userRepo->getUserProfile();

        return view('users.profile.index', compact('eventsuploaded', 'noOfEventUploaded', 'noOfEventTicketsPurchased', 'latestEventTicketsPurchased', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function updateName(Request $request)
    {
        Auth::user()->update([
            'name' => $request->name
        ]);
    }

    public function updateProfile(Request $request)
    {
        ///update the authenticated user's profile
        Auth::User()->profile()->update([
            'gender' => $request->gender,
            'phonenumber' => $request->phonenumber,
            'education' => $request->education,
            'skills' => $request->skills,
            'location' => $request->location,
        ]);
    }

    public function deleteAccount(Request $request, $id)
    {
        //delete user
        User::destroy($id);
        //destroy user session
        $request->session()->flush();
        //redirect back to home
        return redirect()->route('login')->with('success', 'Account deleted successfully');
    }
}
