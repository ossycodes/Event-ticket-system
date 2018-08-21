<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Category;

class CategoryController extends Controller
{
    public function index($id){
        
        $eventsimage = Event::paginate(6);
		//$noofevents = Event::all();
		//$events = Event::orderBy('id', 'DESC')->paginate(3);
        //$allCategories =  Category::all(); die;
        //$categoryName = Category::find($id);
        //echo "<pre>"; print_r(json_decode(json_encode($categoryDetails = Category::where('id', $id)->with('events')->get()))); die;
        $categoryDetails = Category::where('id', $id)->with('events')->orderBy('id', 'DESC')->paginate(1); 
        $maximumId = Category::all()->count(); 
        //$categoryDetails = json_encode(json_decode($categoryDetails)); 
        //return $this->jsonResponse($categoryDetails); die;
        $allCategories = Category::all();
        return view('events.eventviacategory')->with(compact('categoryDetails', 'eventsimage', 'allCategories', 'maximumId'));
       
    }

    public function jsonResponse($data){
        return response()->json($data);
    }
}
