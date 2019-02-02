<?php

namespace App\Repositories\Concretes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\NotificationRepoInterface;


class NotificationRepo implements NotificationRepoInterface
{

    public function getTotalNotifications()
    {
        return DB::table('notifications')->count();
    }

    public function getNotifications()
    {
        return DB::table('notifications')->get();
    }

    public function getReadNotifications()
    {
        return DB::table('notifications')->where('read_at', '!=', null)->count();
    }

    public function getNotificationsInArrayFormat()
    {
        return DB::table('notifications')->toArray();
    }

    public function markAsReadUnreadNotification()
    {
        return Auth::user()->unreadNotifications->markAsRead();
    }

    public function deleteNotification()
    {
        return DB::table('notifications')->delete();
    }

}