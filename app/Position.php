<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $guarded = [];
    protected $table = 'positions';

    public function employee(){
        return $this->belongsToMany(Employee::class);
    }
}
