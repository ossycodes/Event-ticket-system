<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use Validator;

class NewslettersController extends Controller
{
	protected $newsletter;
	//constructor dependency injection, which would be resolved by lararvel service container
	public function __construct(Newsletter $saveNewsletter) {
		$this->newsletter = $saveNewsletter;
	}
	
    public function saveNewsletterSubscriber(Request $request) {
		//validate incoming request
		$this->validateNewsletter($request);
		//save the subscriber
		$this->saveSubscriber($request);
		//return response
		return $this->normalMessage();
    }

	public function validateNewsletter($request) { 
		//validation rule
		$rules = [
			'email' => 'required|email|unique:newsletters|',
		];
		//custom validation error message
		$message = [
			'email.unique' => 'This E-mail is subscribed already.Thank you',
		];

		Validator::make($request->all(), $rules, $message)->validate();
	}

    public function saveSubscriber(Request $request) {

    	$this->newsletter->email = $request->email;
    	return $this->newsletter->save();
	}
	
    public function normalMessage() {
    	return redirect()->back()->with('subscriptionsuccess', 'Successfully Subscribed.');
	}
	
	//TOdo send email to subscribers method
	
}
