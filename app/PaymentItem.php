<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model
{
    protected $guarded = [];

    public function paymentType(){
        return $this->belongsTo(PaymentType::class,'payment_type_id','id');
    }

    public function cashFlow(){
        return $this->hasMany(CashFlow::class,'payment_item_id');
    }
}
