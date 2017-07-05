<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'account';
    protected $fillable = [
        'name',
        'amount'
    ];

    public function finance(){
        return $this->belongsTo(Finance::class,'id','account_id');
    }

    public function accountType(){
        return $this->belongsTo(AccountType::class,'account_type_id','id');
    }
}
