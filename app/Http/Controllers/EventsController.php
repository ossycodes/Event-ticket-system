<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\RedisService;

class EventsController extends Controller
{


    /**
     * EventsController constructor.
     */
    public function __construct()
	{
		$this->middleware('auth')->only('show');
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
	{
		//please refer to eventcomposer for data passed to this view.
		return view('events.events');
	}

    /**
     * @param Request $request
     * @param RedisService $redisService
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, RedisService $redisService, $id)
	{
		$redisService->storeEventPageViews($request, $id);

		//please refer to eventSinglecomposer for data passed to this view.
		return view('events.single');

	}

}
