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
        Repositories\Contracts\CategoryRepoInterface,
        Repositories\Contracts\ContactRepoInterface
}; //php7 grouping use statements

use Illuminate\Support\Facades \{
        Log,
        Mail
}; //php7 grouping use statements


class ContactsController extends Controller
{
    public $contactRepo;
    public $categoryRepo;

    public function __construct(CategoryRepoInterface $categoryRepo, ContactRepoInterface $contactRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->contactRepo = $contactRepo;
    }

    public function index()
    {
        $allCategories = $this->categoryRepo->getAllCategories();
        return view('contactus')->with(compact('allCategories'));
    }

    public function store(ContactusRequest $request)
    {

        try {
            $this->contactRepo->storeContactusMessage($request->all());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
        dispatch(new SendContactUsMailJob($request->all()));
        return back()->with('success', 'Message Sent Successfully');

    }


}
