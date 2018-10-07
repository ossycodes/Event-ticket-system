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

    public function index(){
        $allCategories = Category::all();
        $noofeventsimages =  Event::paginate(6);
        $events = Event::where('status', '=', 1)->orderBy('id', 'DESC')->paginate(3);
        $backgroundInfo =  Background::all();
        return view('index', compact('events', 'backgroundInfo', 'noofeventsimages', 'allCategories'));
    }
    
    // public function testT() {

    //     $res = transform(null, function($value){
    //         return $value * 2;
    //     }, 'this gets returned if the returned value is null');

    //     $res = transform(null, function($value){
    //         return $value * 2;
    //     });

    //     //the null coalesce operator
    //     $res = $res ?? 'damn';

    //     echo $res;

    // }

    public function t() {
        
        $img = Image::make('foo.jpg')->resize(287, 412);

        return $img->response('jpg');
    }

}
