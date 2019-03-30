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

    public function __construct(EventRepoInterface $eventRepo, CategoryRepoInterface $categoryRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->categoryRepo = $categoryRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventsUploadedByUser = $this->eventRepo->getEventsUploadedByUserWithTheTickets();
        return view('users.events.index', compact('eventsUploadedByUser'));
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

     //see if i can succeed in moving this to the storeevent form request
    public function store(StoreEvent $request)
    {
        $stored = $request->uploadEvent();
        if (!$stored) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
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
            //refer to usereventeditcomposer for the data passed to this view
            return view('users.events.edit');
        }
    }

    //TO-do use a clodinary service

    /**
     * @param StoreEvent $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreEvent $request, $id)
    {
        if (Auth::user()->can('update', Event::find($id))) {
            $updateEvent = $request->updateEvent();
            if (!$updateEvent) {
                return redirect()->back()->with('error', 'Something went wrong');
            }
            return redirect()->route('user.events.index')->with('success', 'Event updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreEvent $event, $id)
    {
        if (Auth::user()->can('delete', $event)) {
            $deleteEvent = $event->deleteEvent();
            if (!$deleteEvent) {
                return back()->with('error', 'Something went wrong please try again');
            }
            return back()->with('success', 'Event deleted successfully');
        }

    }


}
