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

    //when you call books() from a User object, it returns all the Book of the User (subscribed to)
    public function books(){
        return $this->hasMany(Book::class);
    }

    public function works_on(){
        // return $this->hasMany(WorksOn::class);    //TODO this isnt working because its looking for userID in works_on to relate the 2 tables, we need it to use SIN instead 
        return $works = WorksOn::where('SIN', '=', $this->SIN)->get();
    }

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

    public function timesheets(){
        return $this->hasMany(Timesheet::class);
    }

    public function department(){
        // return $this->belongsTo(Department::class);
        return Department::find($this->deptID);
    }

    //TODO return just the numbers
    public function phoneNumbers(){
        return $this->hasMany(EmployeePhone::class);
    }

    //equipment they currently have rented out
    public function equipment(){
        return $this->hasMany(Equipment::class);
    }

    public function isManager(){
        return $this->isManager;
    }


    // has the user ever subscribed to book
    public function hasEverSubscribed($book_id)
    {
        $Subscribed = $this->subscriptions()->where('book_id', '=', $book_id)->get();
        return !($Subscribed->isEmpty());
    }

    //is the user currently subscribed to the book
    public function isCurrentSubscriber($book_id)
    {
        $book = Book::findOrFail($book_id);
        return ($this->id == $book->subscription_status);
    }

    public function otherSubscriberExists($book_id){
      $book = Book::findOrFail($book_id);
      return !(empty($book->subscription_status));
    }

  }
