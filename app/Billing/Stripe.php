<?php

namespace App\Billing;

class Stripe {

    protected $key;

    public function __construct($key) {
        $this->key = $key;
    }

    public function doSomething() {
        return "hello world";
    }

}


