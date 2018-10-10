<?php

namespace App\Http\Controllers\user;

use App\User;
use App\Event;
use Validator;
use App\Ticket;
use App\Category;
use Illuminate\Http\Request;
use App\Helper\checkAndUploadImage;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use App\Helper\checkAndUploadUpdatedImage;


class EventsController extends Controller
{
    use checkAndUploadImage,checkAndUploadUpdatedImage ;
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

        $data['user_id'] = Auth::user()->id;

        //upload and store image
        $imageName = $this->checkAndUploadImage($request, $data);
       
        $data['image'] = $imageName;
        
        try{
        //Event::create($data);
        $createdEvent = Event::create([
            'user_id' => $data['user_id'],
            'category_id' => $data['category_id'],
            'image' => $data['image'],
            'name' => $data['name'],
            'venue' => $data['venue'],
            'description' => $data['description'],
            'actors' => $data['actors'],
            'time' => $data['time'],
            'date' => $data['date'],
            'age' => $data['age'],
            'dresscode' => $data['dresscode']
        ])->tickets()->create([
            'regular' => $data['regular'],
            'vip' => $data['vip'],
            'tableforten' => $data['tableforten'],
            'tableforhundred' => $data['tableforhundred'],
        ]);
        //dd($createdEvent->id);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //TODO
        $event = Event::findOrFail($id);
        $eventTicket = Ticket::findOrFail($id);
        $categories = Category::all();
        return view('users.events.edit',compact('event', 'categories', 'eventTicket'));
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
        //validate the incoming request
        $this->validateRequest($request);

        //store all incoming request in a $data variable
        $data = $request->all();

        //to get only the image name from the folder path and extension explode it
        $formerImage = explode('/', $data['imagename']);
       
        $path = 'images/frontend_images/events';

        $data['image'] = $this->checkAndUploadUpdatedImage($data, $request);

        //dd($data);

        $updateEvent = tap(Event::find($id))->update([
            
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'user_id' => Auth::user()->id,
            'venue' => $data['venue'],
            'description' => $data['description'],
            'date' => $data['date'],
            'time' => $data['time'],
            'actors' => $data['actors'],
            'age' => $data['age'],
            'dresscode' => $data['dresscode'],
            'image' => $data['image'],
        
        ]);

        Ticket::find($updateEvent->id)->update([
            'regular' => $data['regular'],
            'vip' => $data['vip'],
            'tableforten' => $data['tableforten'],
            'tableforhundred' => $data['tableforhundred'],
        ]);
        

        return redirect()->route('user.events.index')->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //if the image exists unlink the image
        if(file_exists(Event::find($id)->image)){
            unlink(Event::find($id)->image);
        }
        //delete the event
        Event::destroy($id);
        //return flash session message back to user
        return back()->with('success', 'Event deleted successfully');
    }


    public function validateRequest($request) {
        $message = [
            //custom validation messages.
            'category_id.required' => 'Please select a given category',
            'name.required' => 'Please give the event a name',
            'image.required' => 'Please choose an image for the event',
            'venue.required' => 'Please what is the venue of the event?',
            'description.required' => 'Please give a description of the event',
            'date.required' => 'Please what date is the event?',
            'time.required' => 'Please what time is the event?',
            'age.required' => 'Please what is the age limit?',

        ];

        Validator::make($request->all(), [
            //validation rules
            'name' => 'required',
            'category_id' => 'required|integer',
            'image' => 'required|mimes:jpeg,jpg,png',
            'venue' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
            'actors' =>'nullable|string',
            'age' => 'required|max:90',
            'dresscode' => 'nullable|string',
            'regular' => 'nullable|numeric',
            'vip' => 'nullable|numeric',
            'tableforten' => 'nullable|numeric',
            'tableforhunderd' => 'nullable|numeric',
            
        ], $message)->validate();
    }
    
}
