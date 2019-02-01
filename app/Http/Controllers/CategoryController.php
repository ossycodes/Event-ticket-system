<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    //used __invoke since i have just a single method in this controller
    public function __invoke($id)
    {
        //please refer to EventsViaCategoryComposer for data based  to this view
        return view('events.eventviacategory');
    }

}
