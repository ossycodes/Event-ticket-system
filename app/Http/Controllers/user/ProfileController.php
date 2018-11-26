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
    public function destroy($id)
    {
        echo $id;
        die;
    }

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
