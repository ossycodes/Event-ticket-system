<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Event;
use App\Category;
use App\Repositories\Contracts\UserRepoInterface;
use App\Repositories\Contracts\EventRepoInterface;
use App\Repositories\Contracts\CategoryRepoInterface;

class AdminController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepoInterface $userRepo, EventRepoInterface $eventRepo, CategoryRepoInterface $categoryRepo)
    {
        $this->userRepo = $userRepo;
        $this->eventRepo = $eventRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function getUsers()
    {
        return $this->userRepo->getTotalUsers();
    }

    public function getEvents()
    {
        return $this->eventRepo->getAllEvents();
    }

    public function getCategories()
    {
        return $this->categoryRepo->getAllCategories();
    }
}
