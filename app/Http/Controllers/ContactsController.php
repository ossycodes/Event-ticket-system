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

class ContactsController extends Controller
{

    public function store(Request $request, Contact $saveContactusMessage)
    {

        if ($request->isMethod('post')) {
        
        //validate request
            $this->validateMessage($request);
        
        //then save
            $this->saveMessage($request, $saveContactusMessage);

        //then send mail
            $this->sendMail($request);

        //redirect back to contactus page
            return $this->normalResponse();

        }

        $allCategories = Category::all();
        return view('contactus')->with(compact('allCategories'));
    }

    public function validateMessage(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|min:5|string',
            'phonenumber' => 'required|numeric|digits:11',
        ];

        return $validator = Validator::make($request->all(), $rules)->validate();
    }

    public function saveMessage($request, Contact $saveContactusMessage)
    {

        $saveContactusMessage = new Contact;
        $saveContactusMessage->name = $request->name;
        $saveContactusMessage->email = $request->email;
        $saveContactusMessage->message = $request->message;
        $saveContactusMessage->phonenumber = $request->phonenumber;

        try {
            $saveContactusMessage->save();
        } catch (\Exception $e) {
            Log::error('something went wrong');
            return back()->with('error', 'Something went wrong, please try again later.');
        }

    }

    public function normalResponse()
    {
        return redirect()->back()->with('success', 'Message Sent Successfully');
    }

    public function sendMail($request)
    {
        return Mail::to($request)->send(new ContactusMail($request));
    }
}
