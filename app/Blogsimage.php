<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogsimage extends Model
{
    public function blog(){
        return $this->belongsTo(Blog::classs);
    }
}
