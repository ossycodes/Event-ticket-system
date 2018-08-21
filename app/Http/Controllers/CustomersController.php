<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Hobbie;

class CustomersController extends Controller
{
	/*
	one to one relationship, shows the phoneumber of a customer
	*/
    public function showPhone($id = null){
    	$phoneDetails = Customer::find($id)->phone;
    	echo $phoneDetails; die;
    }
    
/*
One to many relationship, one customer has many hobbies
*/
    public function showAllHobbiesOfCustomer($id){
    	$showAllHobbiesOfCustomer = Customer::find($id)->hobbie;
    	foreach($showAllHobbiesOfCustomer as $showAll){
			echo $showAll;
			//echo $showAll->hobbiename;
    	}
    	//echo $showAllHobbiesOfCustomer; die;
    }

	public function AnotherWayToShowAllHobbiesOfCustomer($id){
    	$showAllHobbiesOfCustomer = Customer::find($id);
    	foreach($showAllHobbiesOfCustomer->hobbie as $showAll){
    		echo $showAll;
    	}
	}
	
	public function showAllHobiesOfCustomerWithIdOfOne(){
		//You to continue to chain constraints onto the relationship query 
		//before finally executing the SQL against your database.
		$showAllHobbiesOfCustomer = Customer::find($id);
		$showAllHobbiesOfCustomer = $showAllHobbiesOfCustomer->hobbie()->where('id', 1)->get();
	}

}

