<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;

class Category extends Model
{
    //name attribute should be mass assignable
    protected $fillable = [
        'name'
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
