<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts \{
        EventRepoInterface,
        TransactionRepoInterface,
        UserRepoInterface
}; //php7 grouping use statements

class UserProfileIndexComposer
{
    protected $eventRepo;
    protected $transactionRepo;
    protected $userRepo;

    public function __construct(EventRepoInterface $eventRepo, TransactionRepoInterface $transactionRepo, UserRepoInterface $userRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->transactionRepo = $transactionRepo;
        $this->userRepo = $userRepo;
    }

    public function compose(View $view)
    {
        $eventsuploaded = $this->eventRepo->getEventsUploadedByUser(Auth::id());
        $noOfEventUploaded = $this->eventRepo->getTotalEventsUploadedByUser(Auth::id());
        $latestEventTicketsPurchased = $this->transactionRepo->getLatestTicketPurchasedByUser(Auth::id());
        $noOfEventTicketsPurchased = $this->transactionRepo->getTotalTicketsPurchasedByUser(Auth::id());
        $profile = $this->userRepo->getUserProfile();
        $view->with(compact('eventsuploaded', 'noOfEventUploaded', 'noOfEventTicketsPurchased', 'latestEventTicketsPurchased', 'profile'));
    }
}