<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use App \{
    Event,
        Category,
        Background
};  //php7 grouping use statements

use App\Repositories\Contracts \{
    EventRepoInterface,
        CategoryRepoInterface
};
use App\Services\RedisService;  //php7 grouping use statements



class IndexController extends Controller
{
    protected $redisService;

    //constructor dependency injection of redisService
    public function __construct(RedisService $redisService)
    {
        $this->redisService = $redisService;
    }

    public function showIndexPage(Request $request)
    {
        $this->redisService->storeIpAddressOfSiteVisitors($request);

        //please refer to IndexComposer for data passed to this view
        return view('index', compact('events', 'noofeventsimages', 'allCategories'));
    }

    public function showAboutusPage()
    {
        return view('aboutus');
    }

}
