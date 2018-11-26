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
use App\Repositories\Contracts\BlogRepoInterface;
use App\Repositories\Contracts\EventRepoInterface;
use Facades\App\Repositories\Contracts\ContactRepoInterface;
use App\Repositories\Contracts\CategoryRepoInterface;
use App\Repositories\Contracts\TransactionRepoInterface;
use App\Repositories\Contracts\UserRepoInterface;
use Facades\App\Repositories\Contracts\NewsletterRepoInterface;


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
    public function __construct(BlogRepoInterface $blogRepo, CategoryRepoInterface $categoryRepo, EventRepoInterface $eventRepo, TransactionRepoInterface $transactionRepo, UserRepoInterface $userRepo)
    {
        $this->middleware('auth');
        $this->blogRepo = $blogRepo;
        $this->categoryRepo = $categoryRepo;
        $this->eventRepo = $eventRepo;
        $this->transactionRepo = $transactionRepo;
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
        $noOfPosts = $this->blogRepo->getTotalEvents();
        $noOfUsers = $this->userRepo->getTotalUsers();
        $noOfCategories = $this->categoryRepo->getTotalCategories();
        $noOfTransactions = $this->transactionRepo->getTotalTransaction();

        //Real-time facades, allows me access methods on this object as though they were static methods
        $noOfSubscribers = NewsletterRepoInterface::getTotalSubscribers();
        $noOfContactusMessages = ContactRepoInterface::getTotalContacts();
        
        return view('home', compact('noOfEvents', 'noOfPosts', 'noOfUsers', 'noOfSubscribers', 'noOfContactusMessages', 'noOfCategories', 'noOfTransactions'));
    }
}
