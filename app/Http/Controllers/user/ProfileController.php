<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App \{
    User,
        Event,
        Profile,
        Transaction,
        Http\Controllers\Controller,
        Http\Requests\updateProfile
}; //php7 grouping use statements

use Illuminate\Support\Facades \{
    DB,
        Auth
}; //php7 grouping use statements

use App\Repositories\Contracts \{
    EventRepoInterface,
        TransactionRepoInterface,
        UserRepoInterface
}; //php7 grouping use statements

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
        $this->userRepo->deleteUser($id);
        //destroy user session
        $request->session()->flush();
        //redirect back to home
        return redirect()->route('login')->with('success', 'Account deleted successfully');
    }
}
