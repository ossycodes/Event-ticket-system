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
        //echo $noOfEventimages->image; die;
        $allBlogPosts = Blog::where('id', $id)->with('postcomments')->get();
        echo "<pre>"; print_r(json_decode(json_encode($allBlogPosts))); die;
    }
}
