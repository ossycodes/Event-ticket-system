<?php

namespace App\Helper;

use Auth;
use Validator;

use App\{
    Event,
    Category,
    Http\Controllers\Controller
}; //php7 grouping use statements

use Illuminate\Http\{
    Request,
    UploadedFile
}; //php7 grouping use statements

use Illuminate\Support\Facades\{
    Log,
    Storage,
    Input
}; //php7 grouping use statements

use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
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
            $uniqueid = Date('Ymdhis') . rand(1, 99999);
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