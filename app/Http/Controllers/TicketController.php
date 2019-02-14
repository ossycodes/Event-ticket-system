<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\TransactionRepoInterface;
use App\Repositories\Contracts\UserRepoInterface;

class TicketController extends Controller
{
    protected $transaction;
    protected $userRepo;

    /**
     * TicketController constructor.
     * @param TransactionRepoInterface $transaction
     * @param UserRepoInterface $userRepo
     */
    public function __construct(TransactionRepoInterface $transaction, UserRepoInterface $userRepo)
    {
        $this->transaction = $transaction;
        $this->userRepo = $userRepo;
    }

    /**
     * @param $userid
     * @param $id
     * @return mixed
     */
    public function downloadTicketReciept(int $userid, int $id)
    {
        $receipt = $this->transaction->getTicketTransactionReceipt($userid, $id);
        $user = $this->userRepo->findUser(Auth::id());
        $pdf = PDF::loadView('users.receipt.ticket', compact('receipt', 'user'));
        return $pdf->download('ticket-receipt.pdf');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showReceiptPage($id) {
        //refer to ticketcomposer fot hte data passed to this view
        return view('users.receipt.receipt', compact('receipt'));
    }
}
