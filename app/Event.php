<?php

namespace App;

use App\Ticket;
use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    protected $path = 'images/frontend_images/events/';

    protected $guarded = [];

    //defines a one to many relationship(an event as many comments)
    public function eventscomment()
    {
        return $this->hasMany(Eventscomment::class);
    }

    //defines an invers one to many relationship(an event has one category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    //defines an Accessors that automatically concatenates
    //the image path to the nam eof the image from the database
    // public function getImageAttribute($image){
    //     return $this->path.$image;
    // }

    /*
    A mutator that does something similar to the accessor above
    public function setImageAttribute($image){
        if(!empty($image)){
            $this->attributes['image'] = 'images/frontend_images/events/'.($image);
        }
    }
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
