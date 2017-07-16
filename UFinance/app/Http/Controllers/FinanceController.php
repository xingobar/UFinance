<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Account;
use App\AccountType;
use App\Finance;
use App\Transaction;
use App\Http\Controllers\AccountTypeController;
use Auth;

class FinanceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function showTransaction(){
        $accountType = new AccountTypeController();
        $types = $accountType->getTypes();
        return view('transaction.show',[
            'types'=>$types
        ]);
    }

    public function create(Request $request){
        $accounts = $request->input('account');
        $types = $request->input('type');
        $amounts = $request->input('amount');
        $total = count($amounts);
        $transaction = new Transaction();
        $request->user()->transanction()->save($transaction);
        for($index = 0 ; $index < $total ; $index++){
            if(empty($types[$index]) || empty($accounts[$index]) || empty($amounts[$index])){
                continue;
            }
            $type = new AccountType([
                'name' => $types[$index]
            ]);
            $account = new Account([
                'name' => $accounts[$index],
                'amount' => $amounts[$index]
            ]);
            $type->save();
            $type->account()->save($account);
            $finance = new Finance([
                'transaction_id'=>$transaction->id,
                'account_id' => $account->id
            ]);
            $finance->save();
        }
        Log::info('create account detail success');
        return redirect('/home');
    }

    public function deleteTransaction(Request $request){
        $transaction_id = $request->input('transaction_id');
        $transaction = Transaction::where('id',$transaction_id)->first();
        $finances  = $transaction->finance()->get();
        foreach($finances as $finance){
            $account = $finance->account()->first();
            Log::info('deleteing account id' . $account->id . ' and finance id ' . $finance->id );
            $account->delete();
            $finance->delete();
            Log::info('account & finance delete success');
        }
        $transaction->delete();
        Log::info($transaction_id . ' delete success');
    }

    public function update(Request $request){
        $transaction_id = $request->input('transaction_id');

        Log::info($transaction_id . ' update success' );
    }
}
