<?php

namespace App;

use App\Event;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
