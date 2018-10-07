<?php

namespace App\Helper;

use Auth;
use App\Event;
use Validator;
use App\Ticket;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Helper\checkAndUploadImage;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

Trait checkAndUploadUpdatedImage 
{
    
    public function checkAndUploadUpdatedImage($data, Request $request) {
        //to get only the image name from the folder path and extension explode it
        $formerImage = explode('/', $data['imagename']);
        //if an image exits in the incoming request and the image was successfully uploaded
        if($request->hasFile('image') and $request->image->isValid()) {
            
            //Delete the previous image from the events folder, if a new image is uploaded
            if (file_exists($data['imagename'])) {
                unlink($data['imagename']);
            }

            $imageName = explode('.', $request->image->getClientOriginalName());
            $imageName = $imageName[0].rand(1, 99999).date('ymdhis').'.'.$request->image->getClientOriginalExtension();
          
            //Intervention resize image pakage starts here
          
            $fp = 'images/frontend_images/events/'.$imageName;

            Image::make(input::file('image'))->resize(287, 412)->save($fp);

            //ends here

            return  $imageName;
     
        }   else{
            return  $formerImage[4];
        }

    }
}