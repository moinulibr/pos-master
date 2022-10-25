<?php

namespace App\Models\Backend\Payment;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //bank relationship
    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id','id');
    }
}
