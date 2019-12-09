<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    public function routeNotificationForNexmo()
    {
        return $this->phone;
    }
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function routeNotificationForSlack($notification)
    {
        return "https://hooks.slack.com/services/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";
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => 'App\Events\UserCreated',
    ];

    //checks if the user has an admin role
    public function checkRole()
    {
        if ($this->role !== 'admin') {
            return true;
        }
        return false;

    }

    public function socialAccounts()
    {
        return $this->hasMany(Socialaccount::class);
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
