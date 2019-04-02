<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','date', 'value', 'description',
      ];
  

      public function project(){
        return $this->belongsTo(Project::class);
      }
      
}
