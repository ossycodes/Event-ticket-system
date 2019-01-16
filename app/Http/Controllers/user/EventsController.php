<?php

namespace App\Http\Controllers\user;

use Validator;
use JD\Cloudder\Facades\Cloudder;

use App \{
    User,
        Event,
        Ticket,
        Category,
        Helper\checkAndUploadImage,
        Http\Controllers\Controller,
        Http\Requests\StoreEvent
}; //php7 grouping use statements

use Illuminate \{
    Http\Request,
        Database\QueryException
}; //php7 grouping use statements

use Illuminate\Support\Facades \{
    Auth,
        Log,
        Input,
        Image
}; //php7 grouping use statements


use App\Repositories\Contracts \{
    EventRepoInterface,
        CategoryRepoInterface,
        TicketRepoInterface
}; //php7 grouping use statements


class EventsController extends Controller
{
    use checkAndUploadImage;

    protected $eventRepo;
    protected $categoryRepo;
    protected $ticketRepo;

    public function __construct(EventRepoInterface $eventRepo, CategoryRepoInterface $categoryRepo, TicketRepoInterface $ticketRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->categoryRepo = $categoryRepo;
        $this->ticketRepo = $ticketRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = $this->eventRepo->getEventsUploadedByUserWithTheTickets();
        return view('users.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepo->getAllCategories();
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
        $path = 'cinemaxii/events/';
        $width = 287;
        $height = 412;

         //upload and store image
        try {
            $imageName = $this->checkAndUploadImage($request, $data, $path, $width, $height);
        } catch (\Cloudinary\Error $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong please try again');
        }

        $data['image'] = $imageName[0];
        $data['public_id'] = $imageName[1];

        $createdEvent = $this->eventRepo->createEvent($data);

        //if the tickettype and price is equals to 1
        if ($data['key'] && $data['value'] === 1) {

            $this->ticketRepo->createEventWithOneTicket($data['key'], $data['value']);

        } elseif ($data['key'] && $data['value'] > 1) {

            //if the tickettype and price is greater than 1
            foreach ($data['key'] as $key => $val) {
                // $this->ticketRepo->createEventWithMultipleTicket($data);
                // $ticket = new Ticket;
                // $ticket->event_id = $createdEvent->id;
                // $ticket->tickettype = $val;
                // $ticket->price = $data['value'][$key];
                // $ticket->save();

            }

        } else {
            //no tickettype and price provided
            $this->ticketRepo->createEventWithNoTicket();
        }

        //return back
        return redirect()->back()->with('success', 'Event created successfully');
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
        if (Auth::user()->can('edit', Event::find($id))) {
            $noOfTickets = $this->ticketRepo->getTotalTickets();
            $event = $this->eventRepo->getEvent($id);
            $ticket = $this->ticketRepo->getTicketsForEvent($id);
            $tickets = $this->ticketRepo->getTicketsForEvent($id);
            $categories = $this->categoryRepo->getAllCategories();
            return view('users.events.edit', compact('event', 'categories', 'ticket', 'tickets', 'noOfTickets'));
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
        if (Auth::user()->can('update', Event::find($id))) {

            if ($request->has('image')) {
                Cloudder::destroyImage($request->public_id);
                Cloudder::delete($request->public_id);
            }

            $data = $request->all();
            $path = 'cinemaxii/events/';
            $width = 287;
            $height = 412;

            try {
                $imageDetails = $this->checkAndUploadImage($request, $data, $path, $width, $height);
            } catch (\Cloudinary\Error $e) {
                Log::error($e->getMessage());
                return back()->with('error', 'Something went wrong please try again');
            }

            $data['image'] = $imageDetails[0];
            $data['public_id'] = $imageDetails[1];

            // $this->eventRepo->updateEvent($id, $data);

            // $updateEvent = Event::find($id)->update([

            //     'name' => $data['name'],
            //     'category_id' => $data['category_id'],
            //     'user_id' => Auth::user()->id,
            //     'venue' => $data['venue'],
            //     'description' => $data['description'],
            //     'date' => $data['date'],
            //     'time' => $data['time'],
            //     'actors' => $data['actors'],
            //     'age' => $data['age'],
            //     'dresscode' => $data['dresscode'],
            //     'image' => $data['image'],
            //     'public_id' => $data['public_id'],
            //     'quantity' => $data['quantity'],

            // ]);

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
        $event = $this->eventRepo->getEvent($id);;
        //$this->eventRepo->getEvent($id);
        
        //Authourizing  delete action using policies via the user model
        if (Auth::user()->can('delete', Event::find($id))) {
            //deletes and destroy the image from cloudinary
            try {
                Cloudder::destroyImage($event->public_id);
                Cloudder::delete($event->public_id);
            } catch (\Cloudinary\Error $e) {
                Log::error($e->getMessage());
                return back()->with('error', 'Something went wrong please try again');
            }

            try {
                //delete the event
                Log::info("Event with {$id} deleted successfully");
                // $this->eventRepo->deleteEvent($id);
                Event::destroy($id);
            } catch (\Exception $e) {
                Log::errro($e->getMessage());
                return back()->with('error', 'Something went wrong please try again');
            }


        }    

        //return flash session message back to user
        return back()->with('success', 'Event deleted successfully');

    }


}
