<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorksOn extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hours'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function hours(){
        return $this->attributes['hours'];
    }
}
