<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = [];

    public function materialUsage(){
        return $this->hasMany('App\MaterialUsage','material_id','id');
    }

    public function delivery(){
        return $this->hasMany(MaterialDelivery::class,'material_id','id');
    }
}
