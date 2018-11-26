<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{


	public function customer()
	{
		return $this->belongsTo('App\Customer')->withDefault([
			'phonenumber' => 'No customer with such details',
		]);
	}


}
