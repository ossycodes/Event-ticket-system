<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
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

class HomeComposer
{
    protected $blogRepo;
    protected $categoryRepo;
    protected $eventRepo;
    protected $transactionRepo;
    protected $userRepo;


    public function __construct(BlogRepoInterface $blogRepo, CategoryRepoInterface $categoryRepo, EventRepoInterface $eventRepo, UserRepoInterface $userRepo)
    {
        $this->blogRepo = $blogRepo;
        $this->categoryRepo = $categoryRepo;
        $this->eventRepo = $eventRepo;
        $this->userRepo = $userRepo;
    }

    public function compose(View $view)
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

        $view->with(compact('noOfEvents', 'noOfPosts', 'noOfUsers', 'noOfSubscribers', 'noOfContactusMessages', 'noOfCategories', 'noOfTransactions'));
    }
}