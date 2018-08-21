<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class ReviewsController extends Controller
{
    public function index(){
        $reviews =  Customer::all();
        return view('videos.reviews', compact('reviews'));
    }
}
