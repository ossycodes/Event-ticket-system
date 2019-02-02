<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Helper\returnIdFromRequestSegment;
use App\Repositories\Contracts\EventRepoInterface;
use App\Repositories\Contracts\TicketRepoInterface;
use App\Repositories\Contracts\CategoryRepoInterface;
use App\Repositories\Contracts\EventCommentRepoInterface;

class AdminEventsEditComposer
{
    use returnIdFromRequestSegment;
    
    protected $eventRepo;
    protected $categoryRepo;
    protected $ticketRepo;
    protected $eventCommentRepo;

    public function __construct(EventRepoInterface $eventRepo, CategoryRepoInterface $categoryRepo, TicketRepoInterface $ticketRepo, EventCommentRepoInterface $eventCommentRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->categoryRepo = $categoryRepo;
        $this->ticketRepo = $ticketRepo;
        $this->eventCommentRepo = $eventCommentRepo;
    }
    
    public function compose(View $view)
    {
        $id = (int) $this->returnIdFromRequestSegment(4);
        $event = $this->eventRepo->getEvent($id);
        $noOfTickets = $this->ticketRepo->getTotalTicketsForEvent($id);
        $tickets = $this->ticketRepo->getTicketsForEvent($id);
        $categories = $this->categoryRepo->getAllCategories();
        $view->with(compact('event', 'categories', 'tickets', 'noOfTickets'));
    }
}