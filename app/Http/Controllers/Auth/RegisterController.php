<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\EmployeePhone;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fName' => ['required', 'string', 'max:50'],
            'lName' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'SIN' => ['required', 'numeric', 'digits:9', 'unique:users' ],
            'address' => ['required', 'string', 'max:255'],
            'DOB' => ['required', 'string', 'max:50'], //['date' , 'date_format:Y-m-d'], 
            'salary' => ['required', 'numeric'],
            'phone' => ['string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $u =  User::create([
            'email' => $data['email'],
            'SIN' => $data['SIN'],
            'isManager' => false,
            'fName' => $data['fName'],
            'lName' => $data['lName'],
            'address' => $data['address'],
            'DOB' => $data['DOB'],
            'salary' => $data['salary'],
            'password' => Hash::make($data['password'])
        ]);

        $phones = explode(', ', $data['phoneNumbers']);
        foreach($phones as $p){
            EmployeePhone::create([
            'phone' => $p,
            'SIN' => $data['SIN'],
            ]);
        }

        return $u;
    }
}
