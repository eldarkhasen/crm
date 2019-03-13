<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = [];

    public function materialUsage(){
        return $this->hasOne('App\MaterialUsage','material_id','id');
    }

    public function delivery(){
        return $this->hasOne(MaterialDelivery::class,'material_id','id');
    }
}
