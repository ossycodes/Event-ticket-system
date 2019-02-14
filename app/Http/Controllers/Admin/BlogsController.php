<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;

use App \{
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



class BlogsController extends Controller
{
    protected $blogRepo;

    /**
     * BlogsController constructor.
     * @param BlogRepoInterface $blogRepo
     */
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
        $postUploaded = $request->uploadPost();

        if (!$postUploaded) {
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
        $updatePost = $request->updatepost();
        if (!$updatePost) {
            return redirect()->route('system-admin.posts.create')->with('error', 'something went wrong');
        }
        return redirect()->route('system-admin.posts.create')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StorePost $post, $id)
    {
        $deletePost = $post->deletePost();
        if (!$deletePost) {
            return redirect()->route('system-admin.posts.create')->with('error', 'something went wrong');
        }
        return redirect()->route('system-admin.posts.index')->with('success', 'Post deleted successfully');
    }

}
