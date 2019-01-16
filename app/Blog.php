<?php

namespace App;

use App\Blogsimage;
use App\Postscomment;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    
    protected $fillable = [
        'title',
        'description',
        'body',
    ];

    

    public function postcomments(){
        return $this->hasMany(Postscomment::class);
    }

    public function blogimage(){
        return $this->hasOne(Blogsimage::class);
    }
}
