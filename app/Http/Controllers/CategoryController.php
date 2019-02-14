<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke($id)
    {
        //please refer to EventsViaCategoryComposer for data based  to this view
        return view('events.eventviacategory');
    }

}
