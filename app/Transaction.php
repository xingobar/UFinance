<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function finance(){
        return $this->hasMany(Finance::class,'transaction_id','id');
    }
}
