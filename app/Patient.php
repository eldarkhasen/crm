<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];
    protected $hidden = array('pivot');

    public function appointments(){
        return $this->hasMany(Appointment::class)->withTimestamps();
    }

    public function cashFlow(){
        return $this->hasMany(CashFlow::class,'patient_id');
    }
}
