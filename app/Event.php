<?php

namespace App;

use App\Ticket;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    use Searchable;
    
    protected $path = 'images/frontend_images/events/';

    protected $guarded = [];

    //defines a one to many relationship(an event as many comments)
    public function eventscomment()
    {
        return $this->hasMany(Eventscomment::class);
    }

    //defines an inverse one to many relationship(an event has one category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
