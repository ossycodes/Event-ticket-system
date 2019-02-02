<?php

namespace App\Repositories\Contracts;

interface NotificationRepoInterface
{
    public function getTotalNotifications();

    public function getNotifications();

    public function getReadNotifications();

    public function getNotificationsInArrayFormat();

    public function markAsReadUnreadNotification();

    public function deleteNotification();
}