<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\JSONResponse\JSONResponse\JSONResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Helper\checkAndUploadImage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, JSONResponse, ValidatesRequests, checkAndUploadImage;
}
