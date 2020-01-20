<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];
    protected $hidden = array('pivot');


    public function cashFlow(){
        return $this->hasMany(CashFlow::class,'patient_id');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class,'patient_id');
    }

    public  function sumOfServices(){
        $sum = 0;
        foreach($this->appointments as $appointment){
            $sum = $sum + $appointment->price;
        }
        return $sum;
    }
}
