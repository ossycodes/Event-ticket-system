<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\User;
use App\Profile;
use Auth;
use App\Event;
use App\Contact;
use App\Eventscomment;
use App\Postscomment;
use App\Newsletter;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $fillable = [
        'name',
        'email',
        'phonenumber',
        'education',
        'location',
        'skills',
    ];

    public function index()
    {

        $noOfSubscribers = Newsletter::count();
        $noOfRegisterdUsers = User::count();
        $noOfEventsPosted = Event::count();
        $usersOnline = User::where('online', 1)->get();
        $postComment = Postscomment::latest()->first();
        $latestEvent = Event::latest()->first();
        try{
            $commentOnEvent = Eventscomment::latest()->first();
        }catch(\ErrorException $e) {
            return $e->getMessage();
        }
        $message = Contact::latest()->first();
        $registeredUsers = User::where('role', 'user')->Orderby('created_at', 'asc')->get();
        
        //logging event
        Log::info('displayed User with email:' .' ' .Auth::user()->email .' ' .'and name:' .' ' .Auth::user()->name .' ' .'profile page');

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

        if($request->has('name')) {
            //update the User field
            $this->updateName($request);
            //update the profile
            $this->updateProfile($request);
            return back()->with('success', 'Profile updated successfully');
        }    

            return back()->with('error', 'Something went wrong');
            
    }

    public function updateName(Request $request){
        //update the user's name
        User::where('id', Auth::user()->id)->update([
            'name' => $request->name
        ]);
    }

    public function updateProfile(Request $request){
        //uupdate the user's profile,
        return User::find(Auth::user()->id)->profile()->updateOrCreate([
            'gender' => $request->gender,
            'phonenumber' => $request->phonenumber,
            'education' => $request->education,
            'skills' => $request->skills,
            'location' => $request->location,
        ]);

    }
}
