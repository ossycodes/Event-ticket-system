<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App \{
        Contact,
        Category,
        Mail\ContactusMail,
        Jobs\SendContactUsMailJob,
        Http\Requests\ContactusRequest,
        Repositories\Contracts\CategoryRepoInterface
}; //php7 grouping use statements

use Illuminate\Support\Facades \{
        Log,
        Mail
}; //php7 grouping use statements


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
        dispatch(new SendContactUsMailJob($request->all()));
        return back()->with('success', 'Message Sent Successfully');

    }


}
