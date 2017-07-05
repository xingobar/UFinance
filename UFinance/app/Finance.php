<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $table = 'finance';
    protected $fillable = [
        'transaction_id',
        'account_id'
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }
    public function account(){
        return $this->hasMany(Account::class,'id','account_id');
    }
}
