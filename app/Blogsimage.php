<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogsimage extends Model
{
    protected $fillable = ['imagename', 'public_id'];

    protected $path = 'images/frontend_images/posts/';

    public function blog()
    {
        return $this->belongsTo(Blog::classs);
    }
}
