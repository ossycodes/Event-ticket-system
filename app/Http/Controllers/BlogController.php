<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Event;
use App\Postscomment;

class BlogController extends Controller
{
    public function show($id){

        $postDetails = Blog::findOrFail($id);
        $postComments = Blog::findOrFail($id)->postcomments;
        $postImage = Blog::findOrFail($id)->blogimage;
    
        return view('post', compact('postDetails', 'postComments', 'postImage'));
    }
}
