<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Log;
use Auth;

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
        $transaction = Transaction::orderBy('created_at','desc')
                        ->where('user_id',Auth::user()->id)
                        ->paginate(5);
        return view('home');
    }
}
