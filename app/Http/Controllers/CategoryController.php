<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Event;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($id){
        
        $eventsimage = Event::paginate(6);
        $allBlogPosts1 = Blog::paginate(6);
        $categoryDetails = Category::where('id', $id)->with('events')->orderBy('id', 'DESC')->paginate(1); 
        $maximumId = Category::all()->count(); 
        $allCategories = Category::all();
        return view('events.eventviacategory')->with(compact('categoryDetails', 'eventsimage', 'allCategories', 'maximumId', 'allBlogPosts1'));
       
    }

    public function jsonResponse($data){
        return response()->json($data);
    }
    
}
