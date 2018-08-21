<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Eventscomment;
use validator;

class EventscommentController extends Controller
{
    public function store(Request $request, EventsComment $saveComment){
        $data =  $request->all();
        $this->validateComment($request);
        //return $this->jsonResponse($data); die;
        return $this->saveContactusMessage($request, $saveComment);
        //echo $data;
    }

    public function validateComment($request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:comment',
            'message' => 'required|min:4',      
        ]);
    }

    public function jsonResponse($data){
        return response()->json($data);
    }

    public function saveContactusMessage(Request $request, Eventscomment $saveComment){
       
        $saveComment->event_id = decrypt($request->event_id);
        $saveComment->name = $request->name;
        $saveComment->email = $request->email;
        $saveComment->message = $request->message;
        
        $saveComment->save();

        return redirect()->back()->with('success', 'Comment has been sent, after being reviewed it would be added.');
    }

}
