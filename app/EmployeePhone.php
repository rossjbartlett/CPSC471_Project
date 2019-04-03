<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeePhone extends Model
{
    public function SIN(){
        // or could convert to User object
        return $this->attributes['SIN'];
    }
    
    public function phone(){
        return $this->attributes['phone'];
    }
}
