<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public static function showProductDetails($id)
    {
        return Product::find($id);
    }
}

