<?php

namespace App\Http\Controllers\Admin;

use Auth;

use App \{
    User,
        Event,
        Contact,
        Profile,
        Newsletter,
        Postscomment,
        Eventscomment,
        Http\Controllers\Controller
}; //php7 grouping use statements

use Illuminate \{
    Http\Request,
        Support\Facades\Log
}; //php7 grouping use statements

use App\Repositories\Contracts \{
    UserRepoInterface,
        EventRepoInterface
}; //php7 grouping use statements

//Real-Time Facades
use Facades\App\Repositories\Contracts \{
    PostCommentInterface,
        ContactRepoInterface,
        NewsletterRepoInterface,
        EventCommentRepoInterface
}; //php7 grouping use statements


class ProfileController extends Controller
{
    protected $userRepo;
    protected $eventRepo;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(UserRepoInterface $userRepo, EventRepoInterface $eventRepo)
    {
        $this->userRepo = $userRepo;
        $this->eventRepo = $eventRepo;
    }

    public function index()
    {

        $noOfSubscribers = NewsletterRepoInterface::getTotalSubscribers();
        $noOfRegisterdUsers = $this->userRepo->getTotalUsers();
        $noOfEventsPosted = $this->eventRepo->getTotalEvents();
        $usersOnline = $this->userRepo->getUsersOnline();
        $postComment = PostCommentInterface::getLatestBlogPostComment();
        $latestEvent = $this->eventRepo->getLatestUploadedEvent();

        try {
            //Real-Time Facade
            $commentOnEvent = EventCommentRepoInterface::getLatestComment();
        } catch (\ErrorException $e) {
            return $e->getMessage();
        }

        //Real-Time Facade
        $message = ContactRepoInterface::getLatestContactusMessage();
        $registeredUsers = $this->userRepo->getUsersInDescendingOrder();
        
        //logging event
        Log::info('displayed User with email:' . ' ' . Auth::user()->email . ' ' . 'and name:' . ' ' . Auth::user()->name . ' ' . 'profile page');

        //returns profile view
        return view('admin.profile.index', compact('registeredUsers', 'message', 'commentOnEvent', 'latestEvent', 'postComment', 'usersOnline', 'noOfSubscribers', 'noOfRegisterdUsers', 'noOfEventsPosted'));
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
            //update the User field
            $this->updateName($request);
            //update the profile
            $this->updateProfile($request);
            return back()->with('success', 'Profile updated successfully');
        }

        return back()->with('error', 'Something went wrong');

    }

    public function updateName(Request $request)
    {
        //update the user's name
        User::where('id', Auth::user()->id)->update([
            'name' => $request->name
        ]);
    }

    public function updateProfile(Request $request)
    {
        //uupdate the user's profile,
        return User::find(Auth::user()->id)->profile()->update([
            'gender' => $request->gender,
            'phonenumber' => $request->phonenumber,
            'education' => $request->education,
            'skills' => $request->skills,
            'location' => $request->location,
        ]);

    }
}
