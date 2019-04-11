<?php

namespace App;

use App\Subscription;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //TODO only manager can change an employees salary, isManager, deptID, deptStartDate, supervisorSIN..
        'email', 'SIN', 'address', 'fName', 'lName', 'DOB', 'salary',  'isManager', 
        'deptID', 'deptStartDate','supervisorSIN', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function works_on(){
        // return $this->hasMany(WorksOn::class);    //TODO this isnt working because its looking for userID in works_on to relate the 2 tables, we need it to use SIN instead 
        return $works = WorksOn::where('SIN', '=', $this->SIN)->get();
    }

    //get projects this user works on
    public function projects(){
        // return $this->hasMany(WorksOn::class);    //TODO this isnt working because its looking for userID in works_on to relate the 2 tables, we need it to use SIN instead 
        $works = $this->works_on();
        $current_projects  = [];
        foreach($works as $w) {
            $p = Project::find($w->projectID);
            if($p) array_push($current_projects, $p);
        }
        return $current_projects;
    }

    //retunr projects AND the hours worked 
    public function projects_hours(){
        $projects_hours = [];
        $works = $this->works_on();
        foreach($works as $w) {
          $p = Project::find($w->projectID);
          if($p) array_push($projects_hours, ['project'=>$p, 'hours'=>$w->hours]);
        }
        return $projects_hours;
    }


    public function isManager(){
        return $this->isManager;
    }

    public function timesheets(){
        return Timesheet::where('SIN','=',$this->SIN)->get();
    }

    public function department(){
        // return $this->belongsTo(Department::class);
        return Department::find($this->deptID);
    }

    public function managedDepartments(){
        if(!$this->isManager()) return [];
        return Department::where('managerSIN', '=', $this->SIN)->get();
    }

    public function phoneNumbers(){
        return EmployeePhone::where('SIN', $this->SIN)->get();
    }

    //equipment they currently have rented out
    public function equipment(){
        return $this->hasMany(Equipment::class);
    }

    // is the user wokring on a given proj
    public function isWorkingOn($projID)
    {
        $w = $this->works_on();
        $p = $w->where('projectID','=',$projID);
        return !($p->isEmpty());
    }
    
    public function supervisor(){
        return User::where('SIN','=',$this->supervisorSIN)->get()->first();
    }

    public function isSupervisor(){
        return User::where('supervisorSIN','=',$this->SIN)->count()>0;
    }

    public function supervisees(){
        return User::where('supervisorSIN','=',$this->SIN)->get();
    }

  }
