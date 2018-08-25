<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postscomment extends Model
{
    public function blog(){
        return $this->belongsto(Blog::class);
    }
}
