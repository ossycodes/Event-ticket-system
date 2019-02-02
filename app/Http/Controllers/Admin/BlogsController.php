<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;

use App \{
    Blog,
        Blogsimage,
        Http\Requests\StorePost,
        Http\Controllers\Controller,
        Helper\checkAndUploadImage,
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
    use checkAndUploadImage;

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
        $posts = $this->blogRepo->getCommentsForBlogPostDescendingOrder();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        try{
            $imageName = $this->checkAndUploadImage($request, $data, $storagePath, $width, $height);
        } catch (\Cloudinary\Error $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong please try again');
        }

        $data['image'] = $imageName[0];
        $data['public_id'] = $imageName[1];

        try {
            $blog = $this->blogRepo->createBlogPost($data);
            $this->blogRepo->createImageForBlogPost($blog->id, $data);
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('system-admin.posts.create')->with('error', 'something went wrong');
        }
        
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
        //refer to the adminposteditcomposer for data passed to this view
        return view('admin.posts.edit');
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
        $tp = $this->blogRepo->updateBlogPost($id, $data);
        $storagePath = 'cinemaxii/blogposts/';
        $width = 640;
        $height = 426;
        $imageName = $this->checkAndUploadImage($request, $data, $storagePath, $width, $height);
        
        $this->blogRepo->updateImageForBlogPost($tp->id, $imageName);
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
        
        $this->blogRepo->deleteBlogPost($id);
        return redirect()->route('system-admin.posts.index')->with('success', 'Post deleted successfully');
    }

}
