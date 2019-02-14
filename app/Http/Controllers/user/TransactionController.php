<?php

namespace App\Http\Controllers\user;


use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        //please refer to UserTransactionIndexComposer for data passed to this view
        return view('users.transaction.index');
    }

}
