<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountType;
use Log;

class AccountTypeController extends Controller
{
    public function show(){
        return view('accounttype.show');
    }

    public function create(Request $request){
        $accountType = new AccountType([
            'name' => $request->input('typeName')
        ]);
        $accountType->save();
        Log::info('add ' . $request->input('typeName') . ' type success' );
        return redirect('/home');
    }
}
