<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialUsage extends Model
{
    protected $guarded = [];

    public function material(){
        return $this->belongsTo('App\Material', 'material_id');
    }

    public  function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
