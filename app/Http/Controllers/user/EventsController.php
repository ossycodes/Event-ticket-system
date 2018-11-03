<?php

namespace App\Http\Controllers\user;

use App\User;
use App\Event;
use Validator;
use App\Ticket;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEvent;
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
    use checkAndUploadImage, checkAndUploadUpdatedImage ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $events = Auth::user()->events()->with('tickets')->get();
       return view('users.events.index', compact('events')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(Auth::user()->can('create')) {
        //     dd('can create');
        // }
        $categories = Category::all();
        return view('users.events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreEvent $request)
    {

        //store the request in a $data variable
        $data = $request->all();

         $data['user_id'] = Auth::user()->id;

         //upload and store image
         try{
            $imageName = $this->checkAndUploadImage($request, $data);
         } catch(\Cloudinary\Error $e) {
             Log::error($e->getMessage());
             return back()->with('error', 'Something went wrong please try again');
         }
       
         $data['image'] = $imageName[0];
         $data['public_id'] = $imageName[1];
         //dd($imageName);

        $createdEvent = Event::create([

            'user_id' => $data['user_id'],
            'category_id' => $data['category_id'],
            'image' => $data['image'],
            'public_id' => $data['public_id'],
            'name' => $data['name'],
            'venue' => $data['venue'],
            'description' => $data['description'],
            'actors' => $data['actors'],
            'time' => $data['time'],
            'date' => $data['date'],
            'age' => $data['age'],
            'dresscode' => $data['dresscode'],
            'quantity' => $data['quantity']

         ]);

        //if the tickettype and price is equals to 1
        if ($data['key'] && $data['value']   === 1) {

            $ticket = new Ticket;
            $ticket->event_id = $createdEvent->id;
            $ticket->tickettype = $data['key'];
            $ticket->price = $data['value'];
            $ticket->save();

        } elseif($data['key'] && $data['value'] > 1) {

            //if the tickettype and price is greater than 1
            foreach($data['key'] as $key => $val) {
                $ticket = new Ticket;
                $ticket->event_id = $createdEvent->id;
                $ticket->tickettype = $val;
                $ticket->price = $data['value'][$key];
                $ticket->save();

            }

        } else{
            //no tickettype and price provided
            $ticket = new Ticket;
            $ticket->event_id = $createdEvent->id;
            $ticket->tickettype = NULL;
            $ticket->price = NULL;
            $ticket->save();
        }

        //return back
        return redirect()->back()->with('success', 'Event created successfully');
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
        //Authourizing  edit action using policies via the user model
        if(Auth::user()->can('edit', Event::find($id))) {
            $event = Event::findOrFail($id);
            $eventTicket = Ticket::findOrFail($id);
            $categories = Category::all();
            return view('users.events.edit',compact('event', 'categories', 'eventTicket'));
        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEvent $request, $id)
    {
        //Authourizing  edit action using policies via the user model
        if(Auth::user()->can('update', Event::find($id))) {
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

        }    

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
        //Authourizing  delete action using policies via the user model
        if(Auth::user()->can('delete', Event::find($id))) {
            //if the image exists unlink the image
            if(file_exists(Event::find($id)->image)){
                unlink(Event::find($id)->image);
            }
            //delete the event
            Event::destroy($id);
            //return flash session message back to user
        }    
        return back()->with('success', 'Event deleted successfully');
    }

    
}
