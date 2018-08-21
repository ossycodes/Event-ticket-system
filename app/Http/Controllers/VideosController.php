<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class VideosController extends Controller
{
    public function index(){
    	$videos = Customer::all();
    	return view('videos.video')->with(compact('videos'));
    }
}
