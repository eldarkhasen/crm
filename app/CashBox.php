<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashBox extends Model
{
    protected $guarded = [];

    public function cashFlow(){
        return $this->hasMany(CashFlow::class,'cash_box_id');
    }
}
