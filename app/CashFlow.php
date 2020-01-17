<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashFlow extends Model
{
    protected $guarded = [];

    public function paymentItem(){
        return $this->belongsTo(PaymentItem::class,'payment_item_id');
    }

    public function cashBox(){
        return $this->belongsTo(CashBox::class,'cash_box_id');
    }
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function userCreated(){
        return $this->belongsTo(User::class,'user_created_id');
    }

    public function appointment(){
        return $this->belongsTo(Appointment::class,"appointment_id");
    }



}
