<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Eventscomment;
use App\Category;
use App\Blog;

class EventsController extends Controller
{
    public function index(){
		
		$allBlogPosts1 = Blog::all();
		$allCategories = Category::all();
		$noofevents = Event::all();
		$eventsimage = Event::paginate(6);
		$noofevents = Event::all();
		$events = Event::orderBy('id', 'DESC')->paginate(3);
    	//echo $custom; die;
    	return view('events.events')->with(compact('events', 'noofevents', 'eventsimage', 'allCategories', 'allBlogPosts1'));
	}
	
	public function show($id){
		
		try{
		
		$allCategories = Category::all();
		$allBlogPosts = Blog::all();
		//echo $allBlogPosts; die;
		$noofevents = Event::all();
		$eventcomments = Event::findOrFail($id)->eventscomment;
		$eventsimage = Event::paginate(6);
		$noofevents = Event::all();
		$events = Event::orderBy('id', 'DESC')->paginate(6);
		$eventDetails = Event::findOrFail($id);
		
		return view('events.single', compact('events', 'noofevents', 'eventsimage', 'eventDetails', 'eventcomments', 'allBlogPosts', 'allCategories'));
		
	} catch(\Exception $e){
			abort(404);
		}
	}

}
