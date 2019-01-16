<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

use App\Repositories\Contracts\{
    BlogRepoInterface, 
    EventRepoInterface
}; //php7 grouping use statements

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
            try{
                $events = $this->eventRepo->searchEvent($request->q, 6);
            } catch(\Exception $e) {
                info($e->getMessage());
                return back()->with('error', 'Error connecting to Algolia Server');
            }
            
        } else {
            $events = [];
        }
        return view('search')->with(compact('events', 'allBlogPosts1'));
    }
}
