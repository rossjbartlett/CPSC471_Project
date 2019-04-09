<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'day', 'startTime', 'endTime', 'month', 'year', 'SIN'
    ];

    public function timesheet(){
        $timesheet = Timesheet::where('year','=',$this->year)->where('month','=',$this->month)->get();
        if (!empty($timesheet)) {
            return $timesheet[0];
        } else {
            return null; //shouldn't ever get here :) 
        }
        
    }
    public function user(){
        $user = User::where('SIN','=',$this->SIN)->get();
        return $user[0];
    }
}
