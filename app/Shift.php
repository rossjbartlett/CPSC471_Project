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
        'day', 'startTime', 'endTime', 'contactName', 'month', 'year'
    ];

    public function timesheet(){
        return $this->belongsTo(Timesheet::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
