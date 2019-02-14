<?php

namespace App\Http\Controllers\Admin;

use App\Eventsliderimages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\EventSliderRequest;
use Illuminate\Support\Facades\Validator;
use Facades\App\Repositories\Contracts\EventSliderRepoInterface;

class EventsliderimagesController extends Controller
{
    public function index()
    {
        $sliders = EventSliderRepoInterface::getSlidersInDescendingOrder();
        return view('admin.eventsimagesliders.index', compact('sliders'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.eventsimagesliders.create');
    }

    /**
     * @param EventSliderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EventSliderRequest $request)
    {
        if (EventSliderRepoInterface::getTotalSliders() === 6) {
            return back()->with('error', 'Number of Imagesliders uploaded already at maximum (6)');
        }

        if($request->uploadSliderImages()) {
            return back()->with('success', 'Events image siders uploaded successfully');
        } else {
            return back()->with('error', 'Something went wrong');
        }
                   
    }

}
