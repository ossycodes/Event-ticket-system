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

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $usersOnline = User::where('online', 1)->get();
        $postComment = Postscomment::latest()->first();
        $latestEvent = Event::latest()->first();
        $commentOnEvent = Eventscomment::latest()->first();
        $message = Contact::latest()->first();
        $registeredUsers = User::where('role', 'user')->Orderby('created_at', 'asc')->get();

        //logging event
        Log::info('displayed User with email:' .' ' .Auth::user()->email .' ' .'and name:' .' ' .Auth::user()->name .' ' .'profile page');

        //returns profile view
        return view('admin.profile.index', compact('registeredUsers', 'message', 'commentOnEvent', 'latestEvent', 'postComment', 'usersOnline'));
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
        //
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
}
