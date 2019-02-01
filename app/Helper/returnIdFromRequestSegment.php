<?php

namespace App\Helper;

trait returnIdFromRequestSegment
{
    public function returnIdFromRequestSegment() {
        return (int) app('Illuminate\Http\Request')->segment('2');
    }
}