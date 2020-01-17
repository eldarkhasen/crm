<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];
    protected $hidden = array('pivot');
    protected $table = 'appointments';

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function services(){
        return $this->belongsToMany(Service::class)->withTimestamps();
    }

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function cashflow(){
        return $this->hasOne(CashFlow::class,"appointment_id");
    }
}
