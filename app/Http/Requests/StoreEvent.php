<?php

namespace App\Http\Requests;

use App\Ticket;
use JD\Cloudder\Facades\Cloudder;
use App\Helper\checkAndUploadImage;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Concretes\EventRepo;
use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\Contracts\BlogRepoInterface;
use App\Repositories\Contracts\EventRepoInterface;
use App\Repositories\Contracts\TicketRepoInterface;
use App\Helper\returnIdFromRequestSegment;

class StoreEvent extends FormRequest
{
    use checkAndUploadImage, returnIdFromRequestSegment;

    protected $ticketRepo;
    protected $blogRepo;
    protected $eventRepo;

    public function __construct(TicketRepoInterface $ticketRepo, BlogRepoInterface $blogRepo, EventRepoInterface $eventRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->ticketRepo = $ticketRepo;
        $this->blogRepo = $blogRepo;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'category_id' => 'required|integer',
            'image' => 'required|mimes:jpeg,jpg,png',
            'venue' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
            'actors' => 'nullable|string',
            'age' => 'required|max:90',
            'dresscode' => 'nullable|string',
            'regular' => 'nullable|numeric',
            'vip' => 'nullable|numeric',
            'tableforten' => 'nullable|numeric',
            'tableforhunderd' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [ 
            'category_id.required' => 'Please select a given category',
            'name.required' => 'Please give the event a name',
            'image.required' => 'Please choose an image for the event',
            'venue.required' => 'Please what is the venue of the event?',
            'description.required' => 'Please give a description of the event',
            'date.required' => 'Please what date is the event?',
            'time.required' => 'Please what time is the event?',
            'age.required' => 'Please what is the age limit?',
        ];
    }

    public function uploadEvent()
    {
        $data = $this->all();
        $data['user_id'] = Auth::user()->id;
        $path = 'cinemaxii/events/';
        $width = 287;
        $height = 412;

        try {
            $imageName = $this->checkAndUploadImage($this, $data, $path, $width, $height);
        } catch (\Cloudinary\Error $e) {
            Log::error($e->getMessage());
            return false;
        }

        $data['image'] = $imageName[0];
        $data['public_id'] = $imageName[1];

        $createdEvent = $this->eventRepo->createEvent($data);
 
        //if the tickettype and price is equals to 1
        if ($data['key'] && $data['value'] === 1) {
            $this->ticketRepo->createEventWithOneTicket($data['key'], $data['value']);
            return true;

        } elseif ($data['key'] && $data['value'] > 1) {
        
            //if the tickettype and price is greater than 1
            foreach ($data['key'] as $key => $val) {
                // $this->this->ticketRepo->createEventWithMultipleTicket($data);
                $ticket = new Ticket;
                $ticket->event_id = $createdEvent->id;
                $ticket->tickettype = $val;
                $ticket->price = $data['value'][$key];
                $ticket->save();
                return true;
            }

        } else {
            //no tickettype and price provided
            $this->ticketRepo->createEventWithNoTicket();
            return true;
        }

        return false;
    }

    public function updateEvent()
    {
        
        $id = $this->returnIdFromRequestSegment(3);
        if ($this->has('image')) {
            Cloudder::destroyImage($this->public_id);
            Cloudder::delete($this->public_id);
        } 

        $data = $this->all();
        $path = 'cinemaxii/events/';
        $width = 287;
        $height = 412;

        try {
            $imageDetails = $this->checkAndUploadImage($this, $data, $path, $width, $height);
        } catch (\Cloudinary\Error $e) {
            Log::error($e->getMessage());
            return false;
        }

        $data['image'] = $imageDetails[0];
        $data['public_id'] = $imageDetails[1];

        $updateEvent = $this->eventRepo->updateEvent($id, $data);
        if (!$updateEvent) {
            return false;
        }
        return true;

    }

    public function deleteEvent()
    {
        $id = $this->returnIdFromRequestSegment(3);
        $event = $this->eventRepo->getEvent($id);
        try {
            Cloudder::destroyImage($event->public_id);
            Cloudder::delete($event->public_id);
        } catch (\Cloudinary\Error $e) {
            Log::error($e->getMessage());
            return false;
        }

        try {
            $this->eventRepo->deleteEvent($id);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
