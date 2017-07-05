<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AccountType;

class AccountType extends Model
{
    protected $table = 'account_type';
    protected $fillable = [
        'name'
    ];

    public function account(){
        return $this->hasMany(Account::class,'account_type_id','id');
    }
    
}
