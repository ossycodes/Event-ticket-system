<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Repositories\Contracts \{
    CategoryRepoInterface,
    EventRepoInterface,
    BlogRepoInterface,
    TicketRepoInterface
}; //php7 grouping use statements

class EventComposer
{
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
        $allBlogPosts1 = $this->blogRepo->getPaginatedBlogPosts(6);
		$allCategories = $this->categoryRepo->getAllCategories();
		$noofevents = $this->eventRepo->getAllEvents();
		$events = $this->eventRepo->getPaginatedActiveEventsWithTickets(3);
        $view->with(compact('events', 'noofevents', 'allCategories', 'allBlogPosts1'));
    }
}