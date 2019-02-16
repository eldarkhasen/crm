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
    protected $hidden = array('pivot');
    protected $table = 'employees';

    public function account(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function hasAccount(){

        $account = $this->account()->count();

        if($account>=1){
            return true;
        }else{
            return false;
        }
    }

    public function positions(){
       return $this->belongsToMany(Position::class)->withTimestamps();
    }

    public function services(){
        return $this->belongsToMany(Service::class)->withTimestamps();
    }
}
