<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountType;
use Log;

class AccountTypeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function show(){
        return view('accounttype.show');
    }

    public function create(Request $request){
        $accountType = new AccountType([
            'name' => $request->input('typeName')
        ]);
        $accountType->save();
        Log::info('add ' . $request->input('typeName') . ' type success' );
        return redirect('/type');
    }

    public function getTypes(){
        $accountTypes = AccountType::distinct()
                        ->select('name')
                        ->orderBy('created_at','desc')
                        ->get();
        return $accountTypes;
    }

    public function showAllTypes(){
        $types = $this->getTypes();
        return view('accounttype.showall',[
            'types'=>$types
        ]);
    }
}
