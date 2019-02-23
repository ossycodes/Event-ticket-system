<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Repositories\Contracts \{
    EventRepoInterface,
    TicketRepoInterface
}; //php7 grouping use statements

use App\Helper\returnIdFromRequestSegment;
use Facades\App\Repositories\Contracts\EventCommentRepoInterface;

class EventSingleComposer
{
	use returnIdFromRequestSegment;

	protected $eventRepo;
	protected $ticketRepo;

	public function __construct(EventRepoInterface $eventRepo, TicketRepoInterface $ticketRepo)
	{
		$this->eventRepo = $eventRepo;
		$this->ticketRepo = $ticketRepo;
    }

    public function compose(View $view)
    {
        $id = $this->returnIdFromRequestSegment();

        $noOfTickets = $this->ticketRepo->totalTicketsForEvent($id);
		$noComments = EventCommentRepoInterface::totalNumberOfComments($id, 1);
		$eventDetails = $this->eventRepo->getEvent($id);
		$view->with(compact('noComments', 'eventDetails', 'noOfTickets'));
    }
}