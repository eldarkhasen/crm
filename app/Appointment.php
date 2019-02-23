<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];
    protected $hidden = array('pivot');
    protected $table = 'appointments';

    public function employee(){
        return $this->hasOne(Employee::class)->withTimestamps();
    }

    public function service(){
        return $this->hasOne(Service::class)->withTimestamps();
    }

    public function patient(){
        return $this->hasOne(Patient::class)->withTimestamps();
    }
}
