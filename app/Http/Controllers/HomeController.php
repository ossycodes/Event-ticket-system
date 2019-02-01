<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    //use __invoke() since i have just one method in this controller
    public function __invoke()
    {
        //please refer to homecomposer for data passed to this view.
        return view('home');
    }
}
