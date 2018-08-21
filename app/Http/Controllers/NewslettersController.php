<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use Validator;

class NewslettersController extends Controller
{
	protected $newsletter;
	//dependency injection, which would be hamdled by lararvel service containers
	public function __construct(Newsletter $saveNewsletter){
		$this->newsletter = $saveNewsletter;
	}
	
    public function saveNewsletterSubscriber(Request $request){

    	$this->validateNewsletter($request);

    	$this->saveSubscriber($request);

    	//return $this->jsonSuccessResponse('Successfully Subscribed');
		return $this->normalMessage();
    }

	public function validateNewsletter($request){ 
		
		$rules = [
			'email' => 'required|email|unique:newsletters|',
		];
		
		$message = [
			'email.unique' => 'This E-mail is subscribed already.Thank you',
		];

		Validator::make($request->all(), $rules, $message)->validate();
	}

    public function saveSubscriber(Request $request){

    	$this->newsletter->email = $request->email;
    	return $this->newsletter->save();
    }

    public function jsonSuccessResponse($message){
    	return response()->json([
    		'Success' => $message
    	]);
    }

    public function normalMessage(){
    	return redirect()->back()->with('subscriptionsuccess', 'Successfully Subscribed.');
    }
}
