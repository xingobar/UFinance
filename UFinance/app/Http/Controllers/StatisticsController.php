<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class StatisticsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function getAllData(){
        $accounts = Account::orderBy('created_at','desc')->get();
        return $accounts;
    }
    public function show(){
        return view('statistics.show');
    }
}
