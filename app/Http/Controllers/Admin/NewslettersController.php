<?php

namespace App\Http\Controllers\Admin;

use App\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Facades\App\Repositories\Contracts\NewsletterRepoInterface;

class NewslettersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Real-time facade
        $subscribers = NewsletterRepoInterface::getSubscribers();
        return view('admin.subscribers.index', compact('subscribers'));
    }

}
