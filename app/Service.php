<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $guarded = [];
    protected $hidden = array('pivot');
    protected $table = 'services';

    public function employees(){
        return $this->belongsToMany(Employee::class)->withTimestamps();
    }
}