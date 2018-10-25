<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = "transfers";
    protected $fillable = ['id_from', 'id_to', 'user_id', 'amount_transfer'];
    
}
