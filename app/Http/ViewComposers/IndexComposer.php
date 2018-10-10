<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Eventsliderimages;

class IndexComposer

{

    protected $eventImages;

    public function __construct(Eventsliderimages $eventImages) {
        $this->eventImages = $eventImages;
    }

    public function compose(View $view) {
        $eventImages =  $this->eventImages::select('slider_imagename')->paginate(6);
        $view->with('eventSliderImages', $eventImages);
    }
}