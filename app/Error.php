<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    const VALIDATION_ERROR = ['code' => '401', 'msg' => 'Oops Something Went Wrong'];

    const SUCCESS_RESPONSE = ['code' => '200', 'msg' => 'Successfull'];
}
