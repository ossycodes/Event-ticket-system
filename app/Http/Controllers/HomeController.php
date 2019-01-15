<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App \{
        Blog,
        User,
        Event,
        Contact,
        Category,
        Newsletter,
        Transaction
}; //php7 grouping use statements

use App\Repositories\Contracts \{
        BlogRepoInterface,
        EventRepoInterface,
        CategoryRepoInterface,
        UserRepoInterface
}; //php7 grouping use statements

//Real-time facade
use Facades\App\Repositories\Contracts\NewsletterRepoInterface;
use Facades\App\Repositories\Contracts\ContactRepoInterface;
use Facades\App\Repositories\Contracts\TransactionRepoInterface;


class HomeController extends Controller
{
    protected $blogRepo;
    protected $categoryRepo;
    protected $eventRepo;
    protected $transactionRepo;
    protected $userRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BlogRepoInterface $blogRepo, CategoryRepoInterface $categoryRepo, EventRepoInterface $eventRepo, UserRepoInterface $userRepo)
    {
        $this->middleware('auth');
        $this->blogRepo = $blogRepo;
        $this->categoryRepo = $categoryRepo;
        $this->eventRepo = $eventRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    //use __invoke() since i have just one method in this controller
    public function __invoke()
    {
        $noOfEvents = $this->eventRepo->getTotalEvents();
        $noOfPosts = $this->blogRepo->getTotalBlogPosts();
        $noOfUsers = $this->userRepo->getTotalUsers();
        $noOfCategories = $this->categoryRepo->getTotalCategories();

        //since i can't go pass Four dependency injections i refactored to real-time facades
        //Real-time facades, allows me access methods on this object as though they were static methods
        $noOfTransactions = TransactionRepoInterface::getTotalTransaction();
        $noOfSubscribers = NewsletterRepoInterface::getTotalSubscribers();
        $noOfContactusMessages = ContactRepoInterface::getTotalContacts();

        return view('home', compact('noOfEvents', 'noOfPosts', 'noOfUsers', 'noOfSubscribers', 'noOfContactusMessages', 'noOfCategories', 'noOfTransactions'));
    }
}
