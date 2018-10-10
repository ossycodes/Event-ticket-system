<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Blog;
use Validator;
use App\Blogsimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;


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
            'image' => 'required',
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
        ])->validate();
        
        $data = $request->all();

        //upload and store image
        $imageName = $this->checkAndUploadImage($request, $data);
       
        $data['image'] = $imageName;
        
        //create post via mass assignment
        try{

        $blog = Blog::create($data);

        Blog::find($blog->id)->blogimage()->create([
            'imagename' => $data['image']
        ]);

        }catch(QueryException $e){
            Log::error($e->getMessage());
            //return flash session error message to view
            return redirect()->route('system-admin.posts.create')->with('error', 'something went wrong');
        }
        
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
        //find or fail
        $post = Blog::findOrFail($id);
        $postImage = Blog::findOrFail($id)->blogimage;
        //return view
        return view('admin.posts.edit', compact('post', 'postImage'));
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
         
        $data = $request->all();
        
         $formerImage = explode('/', $data['formerimage']);

        //if an image exits in the incoming request and the image was successfully uploaded
        if($request->hasFile('image') and $request->image->isValid()) {
            
            //Delete the previous image from the events folder, if a new image is uploaded
            if(file_exists($data['formerimage'])) {
                unlink($data['formerimage']);
                //dd('exists');
            }

            $imageName = explode('.', $request->image->getClientOriginalName());
            $imageName = $imageName[0].rand(1, 99999).date('ymdhis').'.'.$request->image->getClientOriginalExtension();
          
            // //Intervention resize image pakage starts here
          
            $fp = 'images/frontend_images/posts/'.$imageName;

            Image::make(input::file('image'))->resize(640, 423)->save($fp);

            //ends here

            $data['imageName'] = $imageName;
     
        }   else {

             $data['imageName'] = $formerImage[3];

        }

        $tp = tap(Blog::find($id))->update([
            'title' => $data['title'],
            'body' => $data['body'],
            'description' => $data['description'],
        ]);
        
        // dd($data['imagename']);
        // dd($tp->id);

        Blog::find($tp->id)->blogimage()->update([
            'imagename' => $data['imageName']
        ]);

        //update the request
        //Blog::update($request->all());

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
        if(file_exists($i->imagename)) {
            unlink($i->imagename);
        } 

        //delete post by primary key(id)
        Blog::destroy($id);
        
        //log the error
        log::info('User with email:' .' ' .Auth::user()->email .' ' .'just deleted a post with Id number' .' ' .$id);
        
        //return flash success message
        return redirect()->route('system-admin.posts.index')->with('success', 'Post deleted successfully');
    
    }

    public function checkAndUploadImage(Request $request, $data)
    {

            //if the request has an image
            if($request->hasFile('image') and $request->file('image')->isValid()) {
                
                dd($data);
                //Delete the previous image from the events folder, if a new image is uploaded
                if (file_exists($data['imagename'])) {
                    unlink($data['imagename']);
                }

                $path = 'images/frontend_images/posts';
                $imageNameWithNoExtension = explode('.', $request->image->getClientOriginalName()); 
                $imageName =  $imageNameWithNoExtension[0].rand(1, 99999).date('ymdhis').'.'.$request->image->getClientOriginalExtension();
                
                //Intervention resize image pakage starts here
                //This resizes the image and stores it in th epath i specified.
          
                $fp = 'images/frontend_images/posts/'.$imageName;

                Image::make(input::file('image'))->resize(640, 423)->save($fp);

                //ends here
 
                return $imageName;          
                
            } else{
                 return $data['image'] = 'default.jpg';
            }

    }
}
