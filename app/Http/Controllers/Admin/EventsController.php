<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;

use App \{
    Event,
        Ticket,
        Category,
        Eventscomment,
        Helper\checkAndUploadImage,
        Http\Controllers\Controller,
        Http\Requests\StoreEvent
}; //php7 grouping use statements

use Illuminate \{
    Http\Request,
        Http\UploadedFile,
        Support\Facades\Log,
        Support\Facades\Input,
        Database\QueryException,
        Support\Facades\Storage
}; //php7 grouping use statements

use App\Repositories\Contracts \{
    EventRepoInterface,
        CategoryRepoInterface,
        TicketRepoInterface,
        EventCommentRepoInterface
}; //php7 grouping use statements

use JD\Cloudder\Facades\Cloudder;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\MockObject\Stub\Exception;


class EventsController extends Controller
{
    use checkAndUploadImage;

    protected $eventRepo;
    protected $categoryRepo;
    protected $ticketRepo;
    protected $eventCommentRepo;

    public function __construct(EventRepoInterface $eventRepo, CategoryRepoInterface $categoryRepo, TicketRepoInterface $ticketRepo, EventCommentRepoInterface $eventCommentRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->categoryRepo = $categoryRepo;
        $this->ticketRepo = $ticketRepo;
        $this->eventCommentRepo = $eventCommentRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //log event
        Log::info('Displayed a list of available events in database for user with email:' . ' ' . Auth::user()->email . ' ' . 'to see');
        $events = $this->eventRepo->getEventsWithTickets();
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
        Log::info('Displayed a form to create an event for User with email:' . ' ' . Auth::user()->email);
        $categories = $this->categoryRepo->getAllCategories();
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
                $ticket = new Ticket;
                $ticket->event_id = $createdEvent->id;
                $ticket->tickettype = $val;
                $ticket->price = $data['value'][$key];
                $ticket->save();

            }

        } else {
            //no tickettype and price provided
            $this->ticketRepo->createEventWithNoTicket();
        }

        return redirect()->route('system-admin.events.create')->with('success', 'Event created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $event = $this->eventRepo->getEvent($id);
        $noOfTickets = $this->ticketRepo->getTotalTicketsForEvent($id);
        $tickets = $this->ticketRepo->getTicketsForEvent($id);
        $categories = $this->categoryRepo->getAllCategories();
        return view('admin.events.edit', compact('event', 'categories', 'tickets', 'noOfTickets'));
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
        if ($request->has('image')) {
            Cloudder::destroyImage($request->public_id);
            Cloudder::delete($request->public_id);
        }
        
        //store all incoming request in a $data variable
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

        $updateEvent = $this->eventRepo->updateEvent($id, $data);

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
        $event = $this->eventRepo->getEvent($id);

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
            $this->eventRepo->deleteEvent($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong please try again');
        }

        //log the event
        log::info('User with email:' . ' ' . Auth::user()->email . ' ' . 'just deleted an event with Id number' . ' ' . $id);

        //return flash success message
        return redirect()->route('system-admin.events.index')->with('success', 'Event deleted successfully');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($id)
    {
        try {
            $this->eventRepo->deActivateEvent($id);
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
       
        //log the event
        log::info('Event with id of' . ' ' . $id . ' ' . 'just got activated');

        //return flash session success message back to the view.
        return back()->with('success', 'Event successfully activated');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deActivate($id)
    {
        try {
            $this->eventRepo->deActivateEvent($id);
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
        

        //log the event
        log::info('Event with id of' . ' ' . $id . ' ' . 'just got de-activated');
        
        //return flash session success message back to the view.
        return back()->with('success', 'Event successfully De-activated');
    }


}
