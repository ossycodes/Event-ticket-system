<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class RedisService
{

    public function storeIpAddressOfSiteVisitors(Request $request)
    {
        Redis::sadd('pagevisitors', $request->ip());
    }

    public function countNoOfSiteVisitors()
    {
        return count(Redis::smembers('pagevisitors'));
    }

    public function storeEventPageViews(Request $request)
    {
        Redis::sadd('eventpageviews', $request->ip());
    }

    public function countNoOfEventPageViews()
    {
        return count(Redis::smembers('eventpageviews'));
    }

    public function storeBlogPageViews($request)
    {
        Redis::sadd('blogpageviews', $request->ip());
    }

    public function countNoOfBlogPageViews()
    {
        return count(Redis::smembers('blogpageviews'));
    }

}