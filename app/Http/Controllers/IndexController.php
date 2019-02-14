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

    /**
     * IndexController constructor.
     * @param RedisService $redisService
     */
    public function __construct(RedisService $redisService)
    {
        $this->redisService = $redisService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showIndexPage(Request $request)
    {
        $this->redisService->storeIpAddressOfSiteVisitors($request);

        //please refer to IndexComposer for data passed to this view
        return view('index', compact('events', 'noofeventsimages', 'allCategories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAboutusPage()
    {
        return view('aboutus');
    }

}
