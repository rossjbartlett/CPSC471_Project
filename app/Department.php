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
  
      public function hasManager(){
        return ($this->managerSIN != null);
      }
  
      //get the manager
      public function manager(){
        // return $this->belongsTo(User::class);
        if(!$this->hasManager()) return null;
        return $user = user::where('SIN', '=', $this->managerSIN)->get()->first();

      }
}
