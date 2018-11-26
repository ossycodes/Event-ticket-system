<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventsliderimages extends Model
{
    protected $path = 'images/frontend_images/events/';

    protected $fillable = ['slider_imagename'];

    public function getSliderImagenameAttribute($image)
    {
        return $this->path . $image;
    }
}
