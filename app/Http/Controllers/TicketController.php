<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\TransactionRepoInterface;

class TicketController extends Controller
{
    protected $transaction;

    public function __construct(TransactionRepoInterface $transaction)
    {
        $this->transaction = $transaction;

    }

    public function downloadTicketReciept($userid, $id)
    {
        $receipt = $this->transaction->getTicketTransactionReceipt($userid, $id);
        $user = User::findOrFail(Auth::id());
       
        // load view for pdf
        $pdf = PDF::loadView('pdfs.ticket', compact('receipt', 'user'));
 
        //download pdf
        return $pdf->download('ticket-receipt.pdf');
    }
}
