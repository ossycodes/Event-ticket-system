<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Repositories\Contracts \{
    EventRepoInterface,
        CategoryRepoInterface,
        TicketRepoInterface
};
use App\Helper\returnIdFromRequestSegment; //php7 grouping use statements

class UserEventEditComposer
{
    use returnIdFromRequestSegment;

    protected $eventRepo;
    protected $categoryRepo;
    protected $ticketRepo;

    public function __construct(EventRepoInterface $eventRepo, CategoryRepoInterface $categoryRepo, TicketRepoInterface $ticketRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->categoryRepo = $categoryRepo;
        $this->ticketRepo = $ticketRepo;
    }

    public function compose(View $view)
    {
        $id = $this->returnIdFromRequestSegment(3);
        
        $noOfTickets = $this->ticketRepo->getTotalTickets();
        $event = $this->eventRepo->getEvent($id);
        $ticket = $this->ticketRepo->getTicketsForEvent($id);
        $tickets = $this->ticketRepo->getTicketsForEvent($id);
        $categories = $this->categoryRepo->getAllCategories();
        $view->with(compact('event', 'categories', 'ticket', 'tickets', 'noOfTickets'));
    }
}