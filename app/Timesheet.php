<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'month', 'year', 'SIN'
    ];

    public function shifts(){
        return Shift::where('SIN','=',$this->SIN)->where('month','=',$this->month)->where('year','=',$this->year)->get();
    }

    public function user(){
        $user = User::where('SIN','=',$this->SIN)->get();
        return $user[0];
    }

}
