<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','cost', 'maintenanceFreq', 'lastMaintenance', 'userSIN'
      ];
  

      public function user(){
        return $this->belongsTo(User::class);
      }
  
      public function supplier(){
        return $this->belongsTo(Supplier::class);
      }

}
