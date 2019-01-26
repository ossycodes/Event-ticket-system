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

    public function storeEventPageViews(Request $request, $eventId)
    {
        Redis::sadd('eventpageviews'.$eventId, $request->ip());
    }

    public function countNoOfEventPageViews($eventId)
    {
        return count(Redis::smembers('eventpageviews'.$eventId));
    }

    public function storeBlogPageViews($request, $blogId)
    {
        Redis::sadd('blogpageviews'.$blogId, $request->ip());
    }

    public function countNoOfBlogPageViews($blogId)
    {
        return count(Redis::smembers('blogpageviews'.$blogId));
    }

}