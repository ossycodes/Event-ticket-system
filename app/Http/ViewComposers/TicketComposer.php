<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Helper\returnIdFromRequestSegment;
use App\Repositories\Contracts\UserRepoInterface;
use App\Repositories\Contracts\TransactionRepoInterface;

class TicketComposer
{

    use returnIdFromRequestSegment;
    
    protected $transactionRepo;
    protected $userRepo;

    public function __construct(TransactionRepoInterface $transactionRepo, UserRepoInterface $userRepo)
    {
        $this->transactionRepo = $transactionRepo;
        $this->userRepo = $userRepo;
    }

    public function compose(View $view)
    {
        $id = $this->returnIdFromRequestSegment(3);
        $receipt = $this->transactionRepo->getTicketTransactionReceipt(Auth::id(), $id);
        $view->with(compact('receipt'));
    }
}