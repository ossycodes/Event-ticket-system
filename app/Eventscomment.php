<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Eventscomment extends Model
{
    //defines an inverse one to many relationship
    public function event(){
        return $this->belongsTo(Event::class);
    }
}
