<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','budget', 'deptID'
      ];
  
      //TODO get just the users that work on the proj
      public function users(){
        return $this->hasMany(WorksOn::class);
      }
  
      public function department(){
        return $this->belongsTo(Department::class);
      }

      public function budgetItems(){
        return $this->hasMany(BudgetItem::class);
      }

    
}
