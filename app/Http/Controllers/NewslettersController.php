<?php

namespace App\Http\Controllers;

use App\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\Contracts\NewsletterRepoInterface;
use Illuminate\Support\Facades\Validator;

class NewslettersController extends Controller
{
    protected $newsletterRepo;

    /**
     * NewslettersController constructor.
     * @param NewsletterRepoInterface $newsletterRepo
     */
    public function __construct(NewsletterRepoInterface $newsletterRepo)
    {
        $this->newsletterRepo = $newsletterRepo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveNewsletterSubscriber(Request $request)
    {
        $this->validateRequest($request);

        try {
            $this->newsletterRepo->storeNewsletterSubscriber($request->all());
        } catch (\Exception $e) {
			Log::error($e->getMessage());
			return back()->with('error', 'Something went wrong.');
        }

        if ($request->ajax()) {
			return response()->json([
				'status' => 'Subscription successfull'
			], 200);
		}

        return back()->with('subscriptionsuccess', 'Successfully Subscribed.');
    }

    /**
     * @param $request
     */
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
