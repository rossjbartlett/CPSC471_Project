<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeePhone extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SIN','phone'
    ];


    public function SIN(){
        // or could convert to User object
        return $this->attributes['SIN'];
    }
    
    public function phone(){
        return $this->attributes['phone'];
    }
}
