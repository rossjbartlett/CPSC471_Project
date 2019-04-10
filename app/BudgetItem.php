<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class BudgetItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','date', 'value', 'description','projectID'
      ];
  

      public function project(){
        // return $this->belongsTo(Project::class);
        $p = Project::where('id', '=', $this->projectID)->get()->first();
        // dd($p);
        return $p;
      }
      
}
