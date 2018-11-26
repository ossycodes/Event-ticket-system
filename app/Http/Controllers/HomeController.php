<?php

namespace App\Http\Controllers;

use App\Blog;
use App\User;
use App\Event;
use App\Contact;
use App\Category;
use App\Newsletter;
use App\Transaction;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $noOfEvents = Event::all()->count();
        $noOfPosts = Blog::all()->count();
        $noOfUsers = User::where('role', 'user')->count();
        $noOfSubscribers = Newsletter::all()->count();
        $noOfContactusMessages = Contact::all()->count();
        $noOfCategories = Category::all()->count();
        $noOfTransactions = Transaction::count();


        return view('home', compact('noOfEvents', 'noOfPosts', 'noOfUsers', 'noOfSubscribers', 'noOfContactusMessages', 'noOfCategories', 'noOfTransactions'));
    }
}
