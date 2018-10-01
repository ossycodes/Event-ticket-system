<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogsimage extends Model
{
    protected $fillable = ['imagename'];

    protected $path = 'images/frontend_images/posts/';
    
    //defines an Accessors that automatically concatenates
    //the image path to the nam eof the image from the database
    public function getImagenameAttribute($image){
        return $this->path.$image;
    }
    
    
    public function blog(){
        return $this->belongsTo(Blog::classs);
    }
}
