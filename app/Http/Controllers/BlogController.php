<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\RedisService;

class BlogController extends Controller
{
    protected $redisService;

    public function __construct(RedisService $redisService)
    {
        $this->redisService = $redisService;
    }

    public function __invoke(Request $request, $id)
    {
        $this->redisService->storeBlogPageViews($request, $id);
       
        //please refer to the postcomposer for data passed to this view
        return view('post');
    }
}
