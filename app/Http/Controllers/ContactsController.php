<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App \Contact;
use App \Category;
use App \Mail\ContactusMail;
use App \Jobs\SendContactUsMailJob;
use App \Http\Requests\ContactusRequest;
use App \Repositories\Contracts\CategoryRepoInterface;
use App \Repositories\Contracts\ContactRepoInterface; //php7 grouping use statements

use Illuminate\Support\Facades \Log;
use Illuminate\Support\Facades \Mail; //php7 grouping use statements

class ContactsController extends Controller
{
    public $contactRepo;
    public $categoryRepo;

    /**
     * ContactsController constructor.
     * @param CategoryRepoInterface $categoryRepo
     * @param ContactRepoInterface $contactRepo
     */
    public function __construct(CategoryRepoInterface $categoryRepo, ContactRepoInterface $contactRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->contactRepo = $contactRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $allCategories = $this->categoryRepo->getAllCategories();
        return view('contactus')->with(compact('allCategories'));
    }

    /**
     * @param ContactusRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactusRequest $request)
    {
        try {
            $this->contactRepo->storeContactusMessage($request->all());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            
            return back()->with('error', 'Something went wrong');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'ok',
                 'message' => 'Message sent successfully'
            ], 200);
        }
       
        // dispatch(new SendContactUsMailJob($request->all()));

        return back()->with('success', 'Message Sent Successfully');
    }
}
