<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XrayImage extends Model
{
    protected $guarded = [];


    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
