<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	//one to one to relationship, one customer has one phonenumber 
    public function phone(){
    	return $this->hasOne('App\Phone')->withDefault([
    		'Error' => 'No Phonenumber with this customer',
    	]);
    }

    //one to many to relationship, one customer has many hobbies
    public function hobbie(){
    	return $this->hasMany('App\Hobbie');
    }
}
