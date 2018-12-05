<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    public function routeNotificationForNexmo()
    {
        //should return $this->phone
        return '2349023802591';
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //checks if the user has an admin role
    public function checkRole()
    {
        if ($this->role !== 'admin') {
            return true;
        }
        return false;

    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
