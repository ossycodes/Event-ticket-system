<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\RedisService;

class BlogController extends Controller
{
    protected $redisService;

    /**
     * BlogController constructor.
     * @param RedisService $redisService
     */
    public function __construct(RedisService $redisService)
    {
        $this->redisService = $redisService;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(Request $request, $id)
    {
        $this->redisService->storeBlogPageViews($request, $id);
       
        //please refer to the postcomposer for data passed to this view
        return view('post');
    }
}
