<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Postscomment;

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
}
