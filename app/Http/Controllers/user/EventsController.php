<?php

namespace App\Http\Controllers\user;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Event;
use App\User;
use Validator;


class EventsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $events= Auth::user()->events()->latest()->get(); 
       return view('users.events.index', compact('events')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('users.events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the incoming request
        $this->validateRequest($request);
        //store the request in a $data variable
        $data = $request->all();
        //decrypt the encrypted user_id from request
        $data['user_id'] = decrypt($data['user_id']);
      
        //if the request has an image
        if($request->hasFile('image') and $request->file('image')->isValid()){
            
             $path = 'public/images/frontend_images/events';
             $imageNameWithNoExtension = explode('.', $request->image->getClientOriginalName()); 
             $imageName =  $imageNameWithNoExtension[0].rand(1, 99999).date('ymdhis').'.'.$request->image->getClientOriginalExtension();
             $request->image->storeAs($path, $imageName);

             $data['image'] = $imageName;
             
             
        } else{
            $data['image'] = 'default.jpg';
        }

        //dd($data);
        try{
        Event::create($data);
        }catch(QueryException $e){
            //log error
            Log::error($e->getMessage());
            //return flash session error message to view
            return redirect()->route('user.events.create')->with('error', 'something went wrong');
        }
        //return back
        return redirect()->route('user.events.create')->with('success', 'Event added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function validateRequest($request){
        $message = [
            'category_id.required' => 'Please select a given category',
            'name.required' => 'Please give the event a name',
            'image.required' => 'Please choose an image for the event',
            'venue.required' => 'Please what is the venue of the event?',
            'description.required' => 'Please give a description of the event',
            'date.required' => 'Please what date is the event?',
            'time.required' => 'Please what time is the event?',
            'actors.required' => 'Any actors coming?',
            'age.required' => 'Please what is the age limit?',
            'dresscode.required' => 'Please what\'s the dress code, casual or what LOL?'

        ];

        Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required|integer',
            'image' => 'required|mimes:jpeg,jpg,png',
            'venue' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
            'ticket'=> 'required',
            'actors' =>'string',
            'age' => 'required|max:90',
            'dresscode' => 'required',
        ], $message)->validate();
    }
}
