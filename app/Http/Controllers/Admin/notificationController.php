<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use App\Notifications\generalNotification;
use Illuminate\Support\Facades\Notification;
use Validator;

class notificationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $noOfNotifications = DB::table('notifications')->count();
        $noOfUsers = User::all()->count();
        $sentNotifcations = $noOfNotifications / $noOfUsers;
        $readNotifications = DB::table('notifications')->where('read_at', '!=', NULL)->count();
        return view('admin.database_notification.create', compact('sentNotifcations', 'readNotifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $msg = [
            'message.required' => 'Please enter the message to be sent'
        ];

        Validator::make($request->all(), [
            'message' => 'required',
        ], $msg)->validate();

        $users = User::all();
        Notification::send($users, new generalNotification($request->message, $users));
        return back()->with('success', 'Notification has been sent');
    }

   public function markAsRead()
   {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
   } 

   public function deleteNotification()
   {
        DB::table('notifications')->delete();
        return back()->with('success', 'All notification deleted successfully');
   }

   public function viewNotifications()
   {
       dd(DB::table('notifications')->get());
   }

}
