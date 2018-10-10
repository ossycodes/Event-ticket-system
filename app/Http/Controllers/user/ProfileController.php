<?php

namespace App\Http\Controllers\User;

use App\Event;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventsuploaded = Event::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', '1']
        ])->get();

        $noOfEventUploaded = Event::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', '1']
        ])->count();

        $latestEventTicketsPurchased = Transaction::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 'success']
        ])->get();

        $noOfEventTicketsPurchased = Transaction::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 'success']
        ])->count();

        $profile = Auth::user()->profile;
        return view('users.profile.index', compact('eventsuploaded', 'noOfEventUploaded', 'noOfEventTicketsPurchased', 'latestEventTicketsPurchased', 'profile'));
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
        
        //if the request has a name as part of the request;
        if($request->has('name')){
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
    public function destroy($id)
    {
        echo $id; die;
    }

    public function updateName(Request $request){
        //validate the authenticated user request
        Auth::user()->update([
            'name' => $request->name
        ]);
    }

    public function updateProfile(Request $request){
        ///update the authenticated user's profile
        Auth::User()->profile()->updateOrCreate([
            'gender' => $request->gender,
            'phonenumber' => $request->phonenumber,
            'education' => $request->education,
            'skills'=>  $request->skills,
            'location' => $request->location,
        ]);
    }

    public function deleteAccount($id){
        /*
        //delete user
        User::destroy($id);
        //destroy user session
        $request->session()->flush();
        //redirect back to home
        return redirect()->route('home');
        */
    }
}
