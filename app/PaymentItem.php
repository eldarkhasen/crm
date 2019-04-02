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
//    public function getPaymentItemId($name){
//        $paymentItems = array(
//            "fromCashBox"=>1,
//            "toCashBox"=>2,
//            "fromDeposit"=>3,
//            "toDeposit"=>4,
//            "returnCash"=>5,
//            "services"=>6,
//            "debtRepayment"=>7,
//            "buyMaterials"=>8,
//            "empSalary"=>9,
//            "incomes"=>10,
//            "expanse"=>11
//        );
//
//        return $paymentItems[$name];
//    }
}
