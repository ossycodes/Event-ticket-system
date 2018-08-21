<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Hobbie;

class HobbieController extends Controller
{
	/*
	One to many relationship, shows customer with such hobbie
	*/
    public function showCustomerWithHobbie($id){
    	//echo $id; die;
    	$showCustomerWithHobbie = Hobbie::find($id)->customer;
    	echo $showCustomerWithHobbie; die;
    }
}
