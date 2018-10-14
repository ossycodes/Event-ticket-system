<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Event;
use App\Ticket;
use App\Category;
use App\Blogsimage;
use App\Eventscomment;
use Illuminate\Http\Request;

class EventsController extends Controller
{
	public function __construct() {
		$this->middleware('auth')->only('show');	
	}

    public function index(){
		
		$allBlogPosts1 = Blog::paginate(6);
		$allCategories = Category::all();
		$noofevents = Event::all();
		$noofevents = Event::all();
		$events = Event::with('tickets')->where('status', '=', 1)->orderBy('id', 'DESC')->paginate(3);
    	return view('events.events')->with(compact('events', 'noofevents', 'allCategories', 'allBlogPosts1'));
	}
	
	public function show($id){
		
		try{
		
		$allCategories = Category::all();
		$allBlogPosts = Blog::all();
		$noofevents = Event::all();
		$eventcomments = Event::findOrFail($id)->eventscomment;
		$noComments = Eventscomment::where([
											 ['event_id', '=', $id],
											 ['status', '=', 1]
										  ])->count();
		$eventsimage = Event::paginate(6);
		$noofevents = Event::all();
		$events = Event::orderBy('id', 'DESC')->paginate(6);
		$eventDetails = Event::findOrFail($id);
		$eventTickets = Ticket::where('event_id', '=', $id)->first();
		
		return view('events.single', compact('noComments', 'events', 'noofevents', 'eventsimage', 'eventDetails', 'eventcomments', 'allBlogPosts', 'allCategories', 'eventTickets'));
		
	} catch(\Exception $e){
			abort(404);
		}
	}

}
