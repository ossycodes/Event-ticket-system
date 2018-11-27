<?php

namespace App\Http\Controllers;

use App\Error;

use Validator;
use App\Contact;

use App\Category;
use App\Mail\ContactusMail;
use Illuminate\Http\Request;
use App\JSONResponse\JSONResponse;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactusRequest;
use App\Repositories\Contracts\CategoryRepoInterface;

class ContactsController extends Controller
{
    public function __construct(CategoryRepoInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $allCategories = $this->categoryRepo->getAllCategories();
        return view('contactus')->with(compact('allCategories'));
    }

    public function store(ContactusRequest $request, Contact $contact)
    {

        try {
            $contact->create($request->all());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
        Mail::to($request)->send(new ContactusMail($request));
        return back()->with('success', 'Message Sent Successfully');
        $this->sendMail($request->all());

    }


}
