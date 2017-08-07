<?php

namespace App;
use App\Wallet;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table="transactions";
    protected $fillable = ['id_wallet','id_category','user_id', 'amount', 'description', 'with_who'];
    public function wallet()
    {
    	return $this->belongsTo('App\Wallet');
    }
}
