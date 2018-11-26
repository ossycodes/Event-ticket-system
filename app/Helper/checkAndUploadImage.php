<?php

namespace App\Helper;

use Auth;
use App\Event;
use Validator;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use JD\Cloudder\Facades\Cloudder;

trait checkAndUploadImage
{

    public function checkAndUploadImage(Request $request, $data, $path, $width, $height)
    {

                //if the request has an image and was successfully uploaded
        if ($request->hasFile('image') and $request->file('image')->isValid()) {
                    

            $imageNameWithNoExtension = explode('.', $request->image->getClientOriginalName()); 
                 
                    //upload to cloudinary
            $image_size = array("height" => $height, "width" => $width, "crop" => "scale");
            $image_name = $request->file('image')->getRealPath();;
                        // $path = "cinemaxii/events/";
            $uniqueid = Date('Ymdhis') . rand(1, 99999);
                        //uploads the image to cloudinary
            Cloudder::upload($image_name, $path . $uniqueid . $imageNameWithNoExtension[0], $image_size);
            $CloudderArray = Cloudder::getResult();
            $imageInformation = [];
            $image_url = $CloudderArray['url'];
            $image_publicid = $CloudderArray['public_id'];

            return $imageInformation = [$image_url, $image_publicid];
                    //cloundinary ends here


        } else {
            return $imageInformation = ['null', 'null'];
        }



    }

}