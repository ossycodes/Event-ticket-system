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

Trait checkAndUploadUpdatedPostImage {

    public function checkAndUploadUpdatedPostImage(Request $request, $data) {
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

        Image::make(input::file('image'))->resize(640, 426)->save($fp);

        //ends here

        //$data['imageName'] = $imageName;
        return $imageName;
 
        }else {

            //$data['imageName'] = $formerImage[3];
            return $formerImage[3];

        }

    }

}