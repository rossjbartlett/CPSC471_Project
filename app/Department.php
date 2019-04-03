<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','managerSIN'
      ];
  

      //get employees that work for that DEPT
      public function users(){
        // return $this->hasMany(User::class);
        return User::where('deptID', $this->id)->get();
      }

      public function projects(){
        // return $this->hasMany(Project::class);
        return Project::where('deptID', $this->id)->get();
      }
  
  
      //get the manager
      public function manager(){
        //TODO does this work?
        return $this->belongsTo(User::class);
      }
}
