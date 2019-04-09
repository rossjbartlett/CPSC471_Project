<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Supplier;
use App\User;

class Equipment extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','cost', 'maintenanceFreq', 'lastMaintenance', 'userSIN', 'supplierID'
      ];

    public function isRented(){
        return ($this->userSIN != null);
    }

    public function user(){
        if($this->isRented())
            return User::where('SIN', $this->userSIN)->first();
    }
  
    public function supplier(){
        return Supplier::find($this->supplierID);
    }

}
