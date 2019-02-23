<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Eventscomment extends Model
{
    protected $guarded = [];
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
