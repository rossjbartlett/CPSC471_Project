<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'phone', 'email', 'contactName'
    ];

    public function equipment(){
        return $this->hasMany(Equipment::class);
    }

}
