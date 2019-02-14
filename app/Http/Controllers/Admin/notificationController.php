<?php

namespace App\Http\Controllers\Admin;


use Validator;

use Illuminate\Http\Request;
    
use App \{
        User,
        Notifications\generalNotification,
        Http\Controllers\Controller
};  //php7 grouping use statements

use App\Repositories\Contracts \{
    NotificationRepoInterface,
        UserRepoInterface
}; //php7 grouping use statements

class notificationController extends \App\Http\Controllers\Controller
{
    protected $userRepo;
    protected $notificationRepo;

    public function __construct(NotificationRepoInterface $notificationRepo, UserRepoInterface $userRepo)
    {
        $this->notificationRepo = $notificationRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //refer to AdminDatabaseNotificationCreateComposer for data passed to this view.
        return view('admin.database_notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = $this->userRepo->getUser();
        Notification::send($users, new generalNotification($request->message, $users));
        return back()->with('success', 'Notification has been sent');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsRead()
    {
        $this->notificationRepo->markAsReadUnreadNotification();
        return back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteNotification()
    {
        $this->notificationRepo->deleteNotification();
        return back()->with('success', 'All notification deleted successfully');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewNotifications()
    {
        $allNotifications = $this->notificationRepo->getNotificationsInArrayFormat();
        return view('admin.database_notification.create', compact('allNotifications'));
    }

    /**
     * @param $request
     * @return mixed
     */
    public function validateRequest($request)
    {
        $msg = [
            'message.required' => 'Please enter the message to be sent'
        ];

        return Validator::make($request->all(), [
            'message' => 'required|min:5',
        ], $msg)->validate();
    }

}
