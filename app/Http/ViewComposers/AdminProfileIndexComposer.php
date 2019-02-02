<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Contracts\UserRepoInterface;
use App\Repositories\Contracts\EventRepoInterface;
use App\Repositories\Contracts\PostCommentInterface;
use App\Repositories\Contracts\NewsletterRepoInterface;
use Facades\App\Repositories\Contracts\ContactRepoInterface;
use Facades\App\Repositories\Contracts\EventCommentRepoInterface;

class AdminProfileIndexComposer
{
    protected $userRepo;
    protected $eventRepo;
    protected $postCommentRepo;
    protected $newsletterRepo;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(UserRepoInterface $userRepo, EventRepoInterface $eventRepo, PostCommentInterface $postCommentRepo, NewsletterRepoInterface $newsletterRepo)
    {
        $this->userRepo = $userRepo;
        $this->eventRepo = $eventRepo;
        $this->postCommentRepo = $postCommentRepo;
        $this->newsletterRepo = $newsletterRepo;
    }

    public function compose(View $view)
    {
        $noOfSubscribers = $this->newsletterRepo->getTotalSubscribers();
        $noOfRegisterdUsers = $this->userRepo->getTotalUsers();
        $noOfEventsPosted = $this->eventRepo->getTotalEvents();
        $usersOnline = $this->userRepo->getUsersOnline();
        $postComment = $this->postCommentRepo->getLatestBlogPostComment();
        $latestEvent = $this->eventRepo->getLatestUploadedEvent();
        
        $commentOnEvent = EventCommentRepoInterface::getLatestComment();
        $message = ContactRepoInterface::getLatestContactusMessage();
        $registeredUsers = $this->userRepo->getUsersInDescendingOrder();

        $view->with( compact('registeredUsers', 'message', 'commentOnEvent', 'latestEvent', 'postComment', 'usersOnline', 'noOfSubscribers', 'noOfRegisterdUsers', 'noOfEventsPosted'));
    }
}