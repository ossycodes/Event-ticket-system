<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\RedisService;

class EventsController extends Controller
{


	public function __construct()
	{
		$this->middleware('auth')->only('show');
	}

	public function index()
	{
		//please refer to eventcompoer for data passed to this view.
		return view('events.events');
	}

	public function show(Request $request, RedisService $redisService, $id)
	{
		$redisService->storeEventPageViews($request, $id);

		//please refer to eventcompoer for data passed to this view.
		return view('events.single');

	}

}
