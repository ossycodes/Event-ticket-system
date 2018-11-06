<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Event;
use App\Category;

class AdminController extends Controller
{
    public function getUsers() {
        return User::where('role', 'user')->get();
    }

    public function getEvents() {
        return Event::all();
    }

    public function getCategories() {
        return Category::all();
    }
}
