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

    //TODO return just the projects they work_on
    public function projects(){
        return $this->hasMany(WorksOn::class);
    }

    public function timesheets(){
        return $this->hasMany(Timesheet::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
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

    public function isSubscriber(){
      return $this->role=='Subscriber';
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
