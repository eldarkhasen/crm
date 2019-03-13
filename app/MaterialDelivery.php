<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialDelivery extends Model
{
    protected $guarded = [];

    public function material(){
        return $this->belongsTo('App\Material', 'material_id');
    }
}
