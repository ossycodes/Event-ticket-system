<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support \{
    Facades\Log,
        Facades\Hash
}; //php7 grouping use statements

use App\Repositories\Contracts\UserRepoInterface;


class PasswordController extends \App\Http\Controllers\Controller
{
    protected $userRepo;
    protected $request;

    /**
     * PasswordController constructor.
     * @param UserRepoInterface $userRepo
     */
    public function __construct(UserRepoInterface $userRepo, Request $request)
    {
        $this->userRepo = $userRepo;
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //return view
        return view('admin.password.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $this->validateRequest();
        $data = $this->verifyPassword();

        if ($data) {
            if($this->userRepo->updatePassword($this->request->new_password)){
                return redirect('system-admin/admin/change-password')->with('success', 'Password updated successfully');
            }else{
                return redirect('system-admin/admin/change-password')->with('error', 'Something went wrong');
            }
        } else {
            return redirect('system-admin/admin/change-password')->with('error', 'Incorrect password');
        }

    }

    /**
     * @param $request
     * @return bool
     */
    public function verifyPassword()
    {
        $hashedPassowrd = $this->userRepo->getUserPassword();
        if (Hash::check($this->request->old_password, $hashedPassowrd)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function validateRequest()
    {
        return
            Validator::make($this->request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ])->validate();
    }
}
