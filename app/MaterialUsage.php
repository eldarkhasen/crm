<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialUsage extends Model
{
    protected $guarded = [];

    public function material(){
        return $this->hasOne('App\Material', 'id','material_id');
    }

    public  function employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }
}
