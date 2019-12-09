<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Repositories\Contracts\EventRepoInterface;

class EventComposer
{
	protected $eventRepo;

	public function __construct(EventRepoInterface $eventRepo)
	{
		$this->eventRepo = $eventRepo;
	}

	public function compose(View $view)
	{
		$noofevents = $this->eventRepo->getAllEvents();
		$events = $this->eventRepo->getPaginatedActiveEventsWithTickets(3);
		$view->with(compact('events', 'noofevents'));
	}
}
