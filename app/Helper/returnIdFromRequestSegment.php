<?php

namespace App\Helper;

trait returnIdFromRequestSegment
{
    public function returnIdFromRequestSegment(int $number = 2) {
        return (int) app('Illuminate\Http\Request')->segment(3);
    }
}