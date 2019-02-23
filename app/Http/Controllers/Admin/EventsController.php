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
}; //php7 grouping use statements

use JD\Cloudder\Facades\Cloudder;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\MockObject\Stub\Exception;


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
        //refer to admineventseditcomposer for data passed to this view
        return view('admin.events.edit');
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
        $updateEvent = $request->updateEvent();
        if (!$updateEvent) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
        return redirect()->route('system-admin.events.index')->with('success', 'Event updated successfully');

    }


    //create a cloudinary service
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreEvent $event, $id)
    {
        $deleteEvent = $event->deleteEvent();
        if (!$deleteEvent) {
            return back()->with('error', 'Something went wrong please try again');
        }
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
         
        return back()->with('success', 'Event successfully De-activated');
    }


}
