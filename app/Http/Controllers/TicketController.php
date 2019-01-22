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

    public function __construct(TransactionRepoInterface $transaction, UserRepoInterface $userRepo)
    {
        $this->transaction = $transaction;
        $this->userRepo = $userRepo;
    }

    public function downloadTicketReciept($userid, $id)
    {
        $receipt = $this->transaction->getTicketTransactionReceipt($userid, $id);
        $user = $this->userRepo->findUser(Auth::id());
        $pdf = PDF::loadView('users.receipt.ticket', compact('receipt', 'user'));
        return $pdf->download('ticket-receipt.pdf');
    }

    public function showReceiptPage($id) {
        $receipt = $this->transaction->getTicketTransactionReceipt(Auth::id(), $id);
        return view('users.receipt.receipt', compact('receipt'));
    }
}
