<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use Validator;

class NewslettersController extends Controller
{
	protected $newsletter;
	
	public function __construct(Newsletter $newsletter)
	{
		$this->newsletter = $newsletter;
	}

	public function saveNewsletterSubscriber(Request $request)
	{
		$this->validateRequest($request);

		$this->newsletter->store($request->all());

		return back()->with('subscriptionsuccess', 'Successfully Subscribed.');

	}

	public function validateRequest($request)
	{ 
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

}
