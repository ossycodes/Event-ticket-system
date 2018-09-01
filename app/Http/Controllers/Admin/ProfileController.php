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
        $commentOnEvent = Eventscomment::latest()->first();
        $message = Contact::latest()->first();
        $registeredUsers = User::where('role', 'user')->Orderby('created_at', 'asc')->get();
        
        //logging event
        Log::info('displayed User with email:' .' ' .Auth::user()->email .' ' .'and name:' .' ' .Auth::user()->name .' ' .'profile page');

        //returns profile view
        return view('admin.profile.index', compact('registeredUsers', 'message', 'commentOnEvent', 'latestEvent', 'postComment', 'usersOnline', 'noOfSubscribers', 'noOfRegisterdUsers', 'noOfEventsPosted'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        if($request->has('name')){
            
            //update the User field
            $this->updateName($request);
            //update the profile
            $this->updateProfile($request);

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
    public function destroy($id)
    {
        //
    }

    public function updateName(Request $request){
        
        User::where('id', Auth::user()->id)->update([
            'name' => $request->name
        ]);
    }

    public function updateProfile(Request $request){
       
        return User::find(Auth::user()->id)->profile()->update([
            'gender' => $request->gender,
            'phonenumber' => $request->phonenumber,
            'education' => $request->education,
            'skills' => $request->skills,
            'location' => $request->location,
        ]);

    }
}
