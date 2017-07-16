<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';


    public function user(){
        // local key , parent key
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function finance(){
        // foreign key , local key
        return $this->hasMany(Finance::class,'transaction_id','id');
    }
}
