<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{

/***** Eloquent One to One  Relationship ****/
	/*
	//returns empty if there is no relationship(if there is no
	//customer with such id)
	public function customer(){
		return $this->belongsTo('App\Customer');
	}
	*/

	/*
	//returns this-> [] if there is no relationship(if there is no customer 
    //with such $id)
    public function customer(){
    	return $this->belongsTo('App\Customer')->withDefault();
    }
    */

	/*
	//returns this 'phonenumber' => 'No customer with such details'
	if there is no relationshhip(if there is no customer with such id)
   	*/

    public function customer(){
    	return $this->belongsTo('App\Customer')->withDefault([
    		'phonenumber' => 'No customer with such details',
    	]);
    }


}
