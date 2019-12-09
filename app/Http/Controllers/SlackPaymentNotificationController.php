<?php

namespace App\Http\Controllers;

use App\Notifications\TestSlackNotification;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class SlackPaymentNotificationController extends Controller
{
    public function send()
    {
        Auth()->user()->notify(new TestSlackNotification());
    }
}
