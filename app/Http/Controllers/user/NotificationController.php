<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function update()
    {
        \Illuminate\Support\Facades\Auth::user()->unreadNotifications->markAsRead();
        return back();
    }
}
