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
			$user = new User();
			$user->fName = 'Ross';
			$user->lName = 'Bartlett';
			$user->SIN = '123456789';
			$user->DOB = '09/21/1996';
			$user->email = 'rossjbartlett@gmail.com';
			$user->address = '123 Story St Calgary';
			$user->salary = 666123.50;
			$user->isManager = true;
			$user->password = 'password';
			$user->save();

			$dept = new Department();
			$dept->name = 'Research';
			$dept->managerSIN = '123456789';
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
			$dept->SIN = '123456789';
			$dept->projectID = Project::where('name', 'ILIKE', 'BrainCandy')->first()->id; // attach?;
			// $worksOn->user()->attach($user->id);
			// $worksOn->project()->attach($proj->id);

		}

		
}
