<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountType;
use App\Finance;
use App\Transaction;
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
        $typeNumbers = AccountType::where('name',$request->input('typeName'))->count();
        Log::info($typeNumbers);
        if($typeNumbers === 0){
            $accountType->save();
        }
        Log::info('add ' . $request->input('typeName') . ' type success' );
        return redirect('/type');
    }

    public function getTypes(){
        $accountTypes = AccountType::distinct()
                        ->select('name','id')
                        ->orderBy('created_at','desc')
                        ->get();
        return $accountTypes;
    }
    public function deleteTypes(Request $request){
        $id  = $request->input('typeId');
        $accountType = AccountType::find($id);
        $accounts = $accountType->account()->get();
        foreach($accounts as $account){
            $finances = Finance::where('account_id',$account->id)->get();
            foreach($finances as $finance){
                $finance->delete();
            }
            $account->delete();
        }
        AccountType::destroy($id);
        $transactions = Transaction::select('id')->get();
        foreach($transactions as $transaction){
            $count = Finance::where('transaction_id',$transaction->id)->count();
            if($count === 0){
                $transaction->delete();
            }
        }
        Log::info('delete type success ');
    }
}
