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

    public function hasAccount(){
        $this->hasOne(User::class);
    }

    public function positions(){
        $this->hasMany(Position::class);
    }
}
