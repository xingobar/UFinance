<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Auth;
use App\Transaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountTransactions = Transaction::
                    select('transaction.created_at as created_at',
                        'account.name as accountName',
                        'account_type.name as accountTypeName',
                        'account.amount as amount',
                        'transaction.id as transactionId')
                        ->orderBy('transaction.created_at','desc')
                        ->where('user_id',Auth::user()->id)
                        ->join('finance','transaction.id','=','finance.transaction_id')
                        ->join('account','finance.account_id','=','account.id')
                        ->join('account_type','account.account_type_id','=','account_type.id')
                        ->paginate(5);
        $transactions = Transaction::
                        where('user_id',Auth::user()->id)
                        ->orderBy('created_at','desc')->paginate(5);
        return view('home',[
            'transactions'=>$transactions,
            'accounts' => $accountTransactions
        ]);
    }
}
