<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $guarded = [];

    public function store(array $data) {
        return $this->create($data);
    }
    
}
