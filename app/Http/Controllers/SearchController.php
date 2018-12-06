<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BlogRepoInterface;
use App\Repositories\Contracts\EventRepoInterface;

class SearchController extends Controller
{
    protected $eventRepo;
    protected $blogRepo;

    public function __construct(EventRepoInterface $eventRepo, BlogRepoInterface $blogRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->blogRepo = $blogRepo;
    }
    public function __invoke(Request $request)
    {
        if ($request->has('q') && is_string($request->query('q'))) {
            $request->flashOnly('q');
            $allBlogPosts1 = $this->blogRepo->getPaginatedBlogPosts(6);
            $events = Event::search($request->q)->paginate(6);
        } else {
            $events = [];
        }
        return view('search')->with(compact('events', 'allCategories', 'allBlogPosts1'));
    }
}
