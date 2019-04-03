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
        'month', 'year'
    ];

    public function shifts(){
        return $this->hasMany(Shift::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
