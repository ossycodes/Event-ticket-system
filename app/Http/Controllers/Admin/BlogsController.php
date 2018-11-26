<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Blog;
use Validator;
use App\Blogsimage;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use App\Helper\checkAndUploadPostImage;
use Illuminate\Database\QueryException;
use App\Helper\checkAndUploadUpdatedPostImage;


class BlogsController extends Controller
{
    use checkAndUploadPostImage, checkAndUploadUpdatedPostImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //log event
        Log::info('Displayed a list of available posts in database for user with email:' . ' ' . Auth::user()->email . ' ' . 'to see');
        //fetch all posts from database
        $posts = Blog::with(['postcomments' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();
        //dd($posts);
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
        Log::info('Displayed a form to create a post for User with email:' . ' ' . Auth::user()->email);
        //return create post form
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $data = $request->all();
        $storagePath = 'cinemaxii/blogposts/';
        $width = 640;
        $height = 426;
        //upload and store image
        $imageName = $this->checkAndUploadImage($request, $data, $storagePath, $width, $height);
        $data['image'] = $imageName[0];
        $data['public_id'] = $imageName[1];
        // dd($data);

        //create post via mass assignment
        try {

            $blog = Blog::create($data);
            Blog::find($blog->id)->blogimage()->create([
                'imagename' => $data['image'],
                'public_id' => $data['public_id']
            ]);

        } catch (QueryException $e) {
            Log::error($e->getMessage());
            //return flash session error message to view
            return redirect()->route('system-admin.posts.create')->with('error', 'something went wrong');
        }
        
        //log event
        Log::info('User with email:' . ' ' . Auth::user()->email . ' ' . 'just created a post');
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
        //find or fail
        $post = Blog::findOrFail($id);
        $postImage = Blog::findOrFail($id)->blogimage;
        $blogImage = Blogsimage::where('blog_id', '=', $id)->first();
        //return view
        return view('admin.posts.edit', compact('post', 'postImage', 'blogImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        if ($request->has('image')) {
            Cloudder::destroyImage($request->public_id);
            Cloudder::delete($request->public_id);
        }

        $data = $request->all();

        $tp = tap(Blog::find($id))->update([
            'title' => $data['title'],
            'body' => $data['body'],
            'description' => $data['description'],
        ]);

        $storagePath = 'cinemaxii/blogposts/';
        $width = 640;
        $height = 426;

        $imageName = $this->checkAndUploadImage($request, $data, $storagePath, $width, $height);

        Blog::find($tp->id)->blogimage()->update([
            'imagename' => $imageName[0],
            'public_id' => $imageName[1]
        ]);

        Log::info('Blog with ID:' . ' ' . $tp->id . ' ' . 'just got uploaded');

        //return flash success session message to the view
        return redirect()->route('system-admin.posts.create')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $i = Blogsimage::where('blog_id', $id)->first();
        try {
            Cloudder::destroyImage($i->public_id);
            Cloudder::delete($i->public_id);
        } catch (\Cloudinary\Error $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong please try again');
        }
        
        //delete post by primary key(id)
        Blog::destroy($id);
        
        //log the error
        log::info('User with email:' . ' ' . Auth::user()->email . ' ' . 'just deleted a post with Id number' . ' ' . $id);
        
        //return flash success message
        return redirect()->route('system-admin.posts.index')->with('success', 'Post deleted successfully');

    }

}
