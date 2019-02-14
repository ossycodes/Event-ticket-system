<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    User,
    Event,
    Category
}; //php7 grouping use statements

use App\Repositories\Contracts\{
    UserRepoInterface,
    EventRepoInterface,
    CategoryRepoInterface
}; //php7 grouping use statements

class AdminController extends Controller
{
    protected $userRepo;

    /**
     * AdminController constructor.
     * @param UserRepoInterface $userRepo
     * @param EventRepoInterface $eventRepo
     * @param CategoryRepoInterface $categoryRepo
     */
    public function __construct(UserRepoInterface $userRepo, EventRepoInterface $eventRepo, CategoryRepoInterface $categoryRepo)
    {
        $this->userRepo = $userRepo;
        $this->eventRepo = $eventRepo;
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->userRepo->getTotalUsers();
    }

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->eventRepo->getAllEvents();
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categoryRepo->getAllCategories();
    }
}
