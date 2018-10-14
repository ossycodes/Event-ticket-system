<?php

namespace App\Http\Controllers;

use App\Event;
use App\Category;
use App\Background;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class IndexController extends Controller
{
    protected $path = 'images/frontend_images/events/';

    //use __invoke() since i have only one method in this controller.
    public function __invoke() {
        $allCategories = Category::all();
        $noofeventsimages =  Event::paginate(6);
        $events = Event::where('status', '=', 1)->orderBy('id', 'DESC')->paginate(3);
        $backgroundInfo =  Background::all();
        return view('index', compact('events', 'backgroundInfo', 'noofeventsimages', 'allCategories'));
    }

}
