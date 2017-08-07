<?php

namespace App;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';
    protected $fillable = ['name', 'amount', 'user_id'];

    public function transaction()
    {
    	return $this->hasMany('App\Transaction');
    }
}
