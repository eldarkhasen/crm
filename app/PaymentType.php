<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $guarded = [];

    public function paymentItem(){
        return $this->hasOne(PaymentItem::class,'payment_type_id','id');
    }
}
