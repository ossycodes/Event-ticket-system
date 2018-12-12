<?php

namespace App\Http\Controllers;

use Validator;
use App\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\Contracts\NewsletterRepoInterface;

class NewslettersController extends Controller
{
	protected $newsletterRepo;

	public function __construct(NewsletterRepoInterface $newsletterRepo)
	{
		$this->newsletterRepo = $newsletterRepo;
	}

	public function saveNewsletterSubscriber(Request $request)
	{
		$this->validateRequest($request);

		try {
			$this->newsletterRepo->storeNewsletterSubscriber($request->all());
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return back()->with('error', 'Something went wrong.');
		}

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
