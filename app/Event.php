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

    public function eventscomment()
    {
        return $this->hasMany(Eventscomment::class);
    }

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
