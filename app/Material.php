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
        return $this->belongsTo(MaterialDelivery::class);
    }
}
