<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Repositories\Contracts \{
    CategoryRepoInterface,
    EventRepoInterface,
    BlogRepoInterface,
    TicketRepoInterface
}; //php7 grouping use statements

use App\Helper\returnIdFromRequestSegment;
use Facades\App\Repositories\Contracts\EventCommentRepoInterface;

class EventSingleComposer
{
	use returnIdFromRequestSegment;

    protected $categoryRepo;
	protected $eventRepo;
	protected $blogRepo;
	protected $ticketRepo;

	public function __construct(CategoryRepoInterface $categoryRepo, EventRepoInterface $eventRepo, BlogRepoInterface $blogRepo, TicketRepoInterface $ticketRepo)
	{
		$this->categoryRepo = $categoryRepo;
		$this->eventRepo = $eventRepo;
		$this->blogRepo = $blogRepo;
		$this->ticketRepo = $ticketRepo;
    }

    public function compose(View $view)
    {
        $id = $this->returnIdFromRequestSegment();

        $allCategories = $this->categoryRepo->getAllCategories();
		$allBlogPosts = $this->blogRepo->getAllBlogPosts();
		$noofevents = $this->eventRepo->getAllEvents();
		$noOfTickets = $this->ticketRepo->totalTicketsForEvent($id);
		$tickets = $this->ticketRepo->getTicketsForEvent($id);
		$eventcomments = $this->eventRepo->getEventWithComments($id);
		$noComments = EventCommentRepoInterface::totalNumberOfComments($id, 1);
		$eventsimage = $this->eventRepo->getPaginatedEvents(6);
		$noofevents = $this->eventRepo->getAllEvents();
		$events = $this->eventRepo->getPaginatedEventsDescendingOrder(6);
		$eventDetails = $this->eventRepo->getEvent($id);
       
        $view->with(compact('noComments', 'events', 'noofevents', 'eventsimage', 'eventDetails', 'eventcomments', 'allBlogPosts', 'allCategories', 'eventTickets', 'tickets', 'noOfTickets'));
    }
}