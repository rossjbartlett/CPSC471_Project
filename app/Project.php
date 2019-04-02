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
        return $works = WorksOn::where('projectID', '=', $this->id)->get();
    }

    public function users(){
        $works = $this->works_on();
        $users  = [];
        foreach($works as $w) {
            $u = User::find($w->id);
            if($u) array_push($users, $u);
        }
        return $users;
    }

  
      public function department(){
        return $this->belongsTo(Department::class);
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
