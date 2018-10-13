<?php
namespace App\Helper;

use Auth;
use App\Blog;
use Validator;
use App\Blogsimage;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;

Trait checkAndUploadPostImage {
    
public function checkAndUploadPostImage(Request $request, $data) {

        //if the request has an image
        if($request->hasFile('image') and $request->file('image')->isValid()) {

            //dd($data);

            $path = 'images/frontend_images/posts';
            $imageNameWithNoExtension = explode('.', $request->image->getClientOriginalName()); 
            $imageName =  $imageNameWithNoExtension[0].rand(1, 99999).date('ymdhis').'.'.$request->image->getClientOriginalExtension();
            
            //Intervention resize image pakage starts here
            //This resizes the image and stores it in th epath i specified.
      
            $fp = 'images/frontend_images/posts/'.$imageName;

            Image::make(input::file('image'))->resize(640, 426)->save($fp);

            //ends here

            return $imageName;          
            
        } else{
             return $data['image'] = 'default.jpg';
        }
 
    }
}