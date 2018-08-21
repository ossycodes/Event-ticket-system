<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Background;
use App\Event;
use App\Category;

class IndexController extends Controller
{
    protected $path = 'images/frontend_images/events/';

    public function index(){
        $allCategories = Category::all();
        $noofeventsimages =  Event::paginate(6);
        $events = Event::orderBy('id', 'DESC')->paginate(3);
        $backgroundInfo =  Background::all();
        return view('index', compact('events', 'backgroundInfo', 'noofeventsimages', 'allCategories'));
    }

}
