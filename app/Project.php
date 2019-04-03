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

      public function works_on(){
        // return $this->hasMany(WorksOn::class);  
        return WorksOn::where('projectID', '=', $this->id)->get();

    }

    public function users(){
        $works = $this->works_on();
        $users  = [];
        foreach($works as $w) {
            $u = User::where('SIN', '=', $w->SIN)->get();
            if($u) array_push($users, $u->first());
        }
        return $users;
    }

    //get each employee working on the project and their hours on the project 
    //returns an array of dictionaries of [employee,hours]
    public function employee_hours(){
      $employee_hours = [];
      $works = $this->works_on();

      foreach($works as $w) {
        $u = User::where('SIN', '=', $w->SIN)->get();
        if($u) array_push($employee_hours, ['employee'=>$u->first(), 'hours'=>$w->hours]);
      }
      return $employee_hours;
    }


  
      public function department(){
        // return $this->belongsTo(Department::class);
        return Department::find($this->deptID);
      }

      public function budgetItems(){
        // return $this->hasMany(BudgetItem::class);
        $items  = [];
        foreach($items as $b) {
            $b = BudgetItem::where('projectID', '=', $this->id)->get();
            if($b) array_push($items, $b);
        }
        return $items;
      }

    
}
