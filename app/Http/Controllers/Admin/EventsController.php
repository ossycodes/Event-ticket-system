<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Event;
use Validator;
use App\Ticket;
use App\Category;
use App\Eventscomment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEvent;
use Illuminate\Http\UploadedFile;
use JD\Cloudder\Facades\Cloudder;
use App\Helper\checkAndUploadImage;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Helper\checkAndUploadUpdatedImage;
use PHPUnit\Framework\MockObject\Stub\Exception;

class EventsController extends Controller
{
    use checkAndUploadImage, checkAndUploadUpdatedImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //log event
        Log::info('Displayed a list of available events in database for user with email:' .' ' .Auth::user()->email .' ' .'to see');
        $events = Event::with('tickets')->get();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //log event
        Log::info('Displayed a form to create an event for User with email:' .' ' .Auth::user()->email);
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
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
        $path = 'cinemaxii/events/';
        $width = 287;
        $height = 412;

         //upload  image to cloudinary
         try{
            $imageName = $this->checkAndUploadImage($request, $data, $path, $width, $height);
         } catch(\Cloudinary\Error $e) {
             Log::error($e->getMessage());
             return back()->with('error', 'Something went wrong please try again');
         }
         
         $data['image'] = $imageName[0];
         $data['public_id'] = $imageName[1];
         // dd($imageName);
        
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
        if ($data['key'] && $data['value'] === 1) {

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

        return redirect()->route('system-admin.events.create')->with('success', 'Event created successfully');
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

        $event = Event::findOrFail($id);
        $noOfTickets = Ticket::where('event_id', '=', $id)->count();
        $tickets = Ticket::where('event_id', '=', $id)->get();
        $categories = Category::all();
        return view('admin.events.edit',compact('event', 'categories', 'tickets', 'noOfTickets'));
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
        if($request->has('image')) {
            Cloudder::destroyImage($request->public_id);
            Cloudder::delete($request->public_id);
        }
        
        //store all incoming request in a $data variable
        $data = $request->all();
        try{
            $imageDetails = $this->checkAndUploadImage($request, $data);
        } catch(\Cloudinary\Error $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong please try again');
        }

        $data['image'] = $imageDetails[0];
        $data['public_id'] = $imageDetails[1];

        $updateEvent = Event::find($id)->update([
            
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
            'public_id' => $data['public_id'],
            'quantity' => $data['quantity'],
        
        ]);

        return redirect()->route('system-admin.events.index')->with('success', 'Event updated successfully');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        
        //deletes and destroy the image from cloudinary
        try{
            Cloudder::destroyImage($event->public_id);
            Cloudder::delete($event->public_id);
        } catch(\Cloudinary\Error $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong please try again');
        }
        
        //delete the event
        Event::destroy($id);

        //log the event
        log::info('User with email:' .' ' .Auth::user()->email .' ' .'just deleted an event with Id number' .' ' .$id);

        //return flash success message
        return redirect()->route('system-admin.events.index')->with('success', 'Event deleted successfully');
    }

    
    public function activate($id) {
        //find event with given id and activate it
        Event::find($id)->update([
            'status' => 1
        ]);

        //log the event
        log::info('Event with id of' .' ' .$id .' ' .'just got activated');

        //return flash session success message back to the view.
        return back()->with('success', 'Event successfully activated');
    }

    public function deActivate($id) {
        //find event with given id and activate it
        Event::find($id)->update([
            'status' => 0
        ]);
        //log the event
        log::info('Event with id of' .' ' .$id .' ' .'just got de-activated');
        
        //return flash session success message back to the view.
        return back()->with('success', 'Event successfully De-activated');
    }

    public function viewComments($id) {
        $eventComments = Eventscomment::where('event_id', '=', $id)->get();
        $noOfComments =  EventsComment::count();
        return view('admin.events.comments', compact('eventComments', 'noOfComments'));
    }

    public function activateComment($id) {
        try{

            Eventscomment::where('id', '=', $id)
                        ->update([
                            'status' => 1
                        ]);

            } catch(Exception $e) {
                return back()->with('success', 'Comment successfully de-activated');
            }               
        return back()->with('success', 'Comment successfully activated');                
    }

    public function deactivateComment($id) {
        try{

            Eventscomment::where('id', '=', $id) 
                ->update([
                    'status' => 0
                ]);
        
        } catch(Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
        
        return back()->with('success', 'Comment successfully de-activated');
    }

    public function deleteComment($id) {
        Eventscomment::destroy($id);
        return back()->with('success', 'Comment deleted successfully');
    }
}
