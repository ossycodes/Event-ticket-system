<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App \{
    User,
        Http\Controllers\Controller,
        Repositories\Contracts\UserRepoInterface
}; //php7 grouping use statements

class UsersController extends Controller
{
    protected $userRepo;

    /**
     * UsersController constructor.
     * @param UserRepoInterface $userRepo
     */
    public function __construct(UserRepoInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepo->getUser();
        return view('admin.users.index', compact('users'));
    }

}
