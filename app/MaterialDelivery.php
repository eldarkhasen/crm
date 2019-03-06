<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialDelivery extends Model
{
    protected $guarded = [];

    public function materials(){
        $this->hasMany(Material::class);
    }
}
