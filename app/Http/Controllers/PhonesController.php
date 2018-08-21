<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phone;

class PhonesController extends Controller
{
	public function showCustomer($id=null){
		$customerDetails = Phone::find($id)->customer;
		echo $customerDetails; die;
	}    
}
