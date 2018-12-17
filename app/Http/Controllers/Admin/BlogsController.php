<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;

use App \{
    Blog,
        Blogsimage,
        Http\Requests\StorePost,
        Http\Controllers\Controller,
        Helper\checkAndUploadPostImage,
        Repositories\Contracts\BlogRepoInterface
}; //php7 grouping use statements

use Illuminate \{
    Http\Request,
        Support\Facades\Input,
        Database\QueryException,
        Support\Facades\Log
}; //php7 grouping use statements

use JD\Cloudder\Facades\Cloudder;
use Intervention\Image\Facades\Image;


class BlogsController extends Controller
{
    use checkAndUploadPostImage;

    protected $blogRepo;

    public function __construct(BlogRepoInterface $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

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
        $posts = $this->blogRepo->getCommentsForBlogPostDescendingOrder();
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
        try{
            $imageName = $this->checkAndUploadImage($request, $data, $storagePath, $width, $height);
        } catch (\Cloudinary\Error $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong please try again');
        }

        $data['image'] = $imageName[0];
        $data['public_id'] = $imageName[1];

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->blogRepo->getBlog($id);
        $postImage = $this->blogRepo->getBlogImage($id);
        $blogImage = $this->blogRepo->getImageForBlogPost($id);
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

        $i = $this->blogRepo->getImageForBlogPost($id);
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
