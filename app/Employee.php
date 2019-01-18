<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Model
{
    use HasRoles;
    use Notifiable;

    protected $guarded = [];

    protected $table = 'employees';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function hasUser(){

        $account = $this->user()->count();

        if($account>=1){
            return true;
        }else{
            return false;
        }
    }

    public function positions(){
       return $this->belongsToMany(Position::class);
    }
}
