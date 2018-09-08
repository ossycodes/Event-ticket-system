<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Event;
use App\Postscomment;

class BlogController extends Controller
{
    public function show($id){
        
        $eventsimages = Event::all();
        //$postDetails = Blog::where('id', $id)->with('postcomments')->get();
        //$postDetails = Blog::find($id)->first();
        $postDetails = Blog::findOrFail($id)->with('postcomments')->first();
        
        //echo "<pre>"; print_r(json_decode(json_encode($postDetails))); die;
        return view('post', compact('postDetails'));
    }
}
