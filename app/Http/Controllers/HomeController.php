<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use App\Event;
use App\Blog;
use App\User;
use App\Contact;
use App\Category;


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
        $noOfUsers = User::all()->count();
        $noOfSubscribers = Newsletter::all()->count();
        $noOfContactusMessages = Contact::all()->count();
        $noOfCategories = Category::all()->count();
        

        return view('home', compact('noOfEvents', 'noOfPosts', 'noOfUsers', 'noOfSubscribers', 'noOfContactusMessages', 'noOfCategories'));
    }
}
