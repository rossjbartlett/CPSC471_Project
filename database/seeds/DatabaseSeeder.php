<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Project;
use App\Department;
use App\WorksOn;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
			// $user = new User();
			// $user->fName = 'Ross';
			// $user->lName = 'Bartlett';
			// $user->SIN = '123456789';
			// $user->DOB = '09/21/1996';
			// $user->email = 'rossjbartlett@gmail.com';
			// $user->address = '123 Story St Calgary';
			// $user->salary = 666123.50;
			// $user->isManager = true;
			// $user->password = 'password';
			// $user->save();
			$user = User::create([
				'email' => 'rossjbartlett@gmail.com',
				'SIN' => 123456789,
				'isManager' => true,
				'fName' => 'Ross',
				'lName' => 'Bartlett',
				'address' => '123 Story St Calgary',
				'DOB' => '09/21/1996',
				'salary' => 666123.50,
				'password' => Hash::make('password')
			]);

			$dept = new Department();
			$dept->name = 'Research';
			$dept->managerSIN = 123456789;
			// $dept->manager()->attach($user->id);
			$dept->managerStartDate = '03/01/2019';
			$dept->save();



			$user->deptID = Department::where('name', 'ILIKE', 'Research')->first()->id; // attach?
			$user->deptStartDate = '03/01/2019';
			$user->save();


			$proj = new Project();
			$proj->name = 'BrainCandy';
			$proj->deptID = Department::where('name', 'ILIKE', 'Research')->first()->id; // attach?
			$proj->budget = 1000000;
			$proj->save();

			$worksOn = new WorksOn();
			$worksOn->hours = 69.3;
			$worksOn->SIN = User::where('fName', 'ILIKE', 'Ross')->first()->SIN;
			$worksOn->projectID = Project::where('name', 'ILIKE', 'BrainCandy')->first()->id; // attach?;
			// $worksOn->user()->attach($user->id);
			// $worksOn->project()->attach($proj->id);
			$worksOn->save();


			$carmen = User::create([
				'email' => 'carmen@hotmail.ca',
				'SIN' => 987654321,
				'isManager' => false,
				'fName' => 'Carmen',
				'lName' => 'Ngo',
				'address' => '321 Varsity Ave Calgary',
				'DOB' => '03/05/1996',
				'salary' => 3000000,
				'password' => Hash::make('password')
			]);


			$cs_dept = Department::create([
				'name' => 'Computer Science',
				'managerSIN' => null,
				'managerStartDate' => null
			]);

			$carmen->deptID = $cs_dept->id;
			$carmen->deptStartDate = '04/02/2019';
			$carmen->save();

			$projX = new Project();
			$projX->name = 'Project X';
			$projX->deptID = $cs_dept->id;
			$projX->budget = 9000;
			$projX->save();

			$worksOn = new WorksOn();
			$worksOn->hours = 10.5;
			$worksOn->SIN = $carmen->SIN;
			$worksOn->projectID = $projX->id;
			// $worksOn->user()->attach($user->id);
			// $worksOn->project()->attach($proj->id);
			$worksOn->save();

		}

		
}
