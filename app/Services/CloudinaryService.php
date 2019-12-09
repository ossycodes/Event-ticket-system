<?php

namespace App\Services;

use JD\Cloudder\Facades\Cloudder;

class CloudinaryService
{
    public function uploadImage()
    {
        // Cloudder::upload($image_name, $path . $uniqueid . $imageNameWithNoExtension[0], $image_size);
    }

    public function getResult()
    {
        // Cloudder::getResult();
    }

    public function deleteImage()
    {
        // Cloudder::destroyImage($this->public_id);
        // Cloudder::delete($this->public_id);
    }
}
