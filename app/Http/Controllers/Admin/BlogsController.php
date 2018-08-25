<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Blog;
use Validator;
use Auth;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //log event
        Log::info('Displayed a list of available posts in database for user with email:' .' ' .Auth::user()->email .' ' .'to see');
        //fetch all posts from database
        $posts = Blog::all();
        //return to the index page posts fetched
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //log event
        Log::info('Displayed a form to create a post for User with email:' .' ' .Auth::user()->email);
        //return create post form
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate incoming request
        Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
        ])->validate();
        
        //create post via mass assignment
        Blog::create($request->all());
        
        //log event
        Log::info('User with email:' .' ' .Auth::user()->email .' ' .'just created a post');
        
        //return flash success message
        return redirect()->route('system-admin.posts.create')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "edit form";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete post by primary key(id)
        Blog::destroy($id);

        log::info('User with email:' .' ' .Auth::user()->email .' ' .'just deleted a post with Id number' .' ' .$id);
        //return flash success message
        return redirect()->route('system-admin.posts.index')->with('success', 'Post deleted successfully');
    }
}
