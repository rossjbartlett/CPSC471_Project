<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Project;
use App\BudgetItem;
use App\Department;
use App\WorksOn;
use App\Supplier;
use App\Equipment;
use App\Timesheet;
use App\Shift;
use App\EmployeePhone;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
			$ross = User::create([
				'email' => 'ross@gmail.com',
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

			$ross->deptID = $dept->id; // attach?
			$ross->deptStartDate = '03/01/2019';
			$ross->save();


			$proj = new Project();
			$proj->name = 'BrainCandy';
			$proj->deptID = $dept->id; // attach?
			$proj->budget = 1000000;
			$proj->save();


			$b = new BudgetItem();
			$b->projectID = $proj->id;
			$b->name = 'January Revenue';
			$b->date = '01/30/2019';
			$b->value = 250500;
			$b->description = 'Income from revenue from January 2019';
			$b->save();


			$b = new BudgetItem();
			$b->projectID = $proj->id;
			$b->name = 'Network Upgrade';
			$b->date = '12/14/2018';
			$b->value = -14000;
			$b->description = 'Had to upgrade network in december.';
			$b->save();



			$worksOn = new WorksOn();
			$worksOn->hours = 69.3;
			$worksOn->SIN = $ross->SIN;
			$worksOn->projectID = $proj->id; // attach?;
			// $worksOn->user()->attach($user->id);
			// $worksOn->project()->attach($proj->id);
			$worksOn->save();


			//non manager
			$carmen = User::create([
				'email' => 'carmen@gmail.com',
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

			$worksOn = new WorksOn();
			$worksOn->hours = 25;
			$worksOn->SIN = $carmen->SIN;
			$worksOn->projectID = $proj->id; // attach?;
			$worksOn->save();

			$b = new BudgetItem();
			$b->projectID = $projX->id;
			$b->name = 'Hotel Rental';
			$b->date = '05/12/2018';
			$b->value = -3000;
			$b->description = 'price of BestWestern for 2 employees for 1 week';
			$b->save();


			$b = new BudgetItem();
			$b->projectID = $projX->id;
			$b->name = 'April Sales';
			$b->date = '04/30/2019';
			$b->value = 114000;
			$b->description = 'Income from revenue from April 2019';
			$b->save();


			$supplier = new Supplier();
			$supplier->name = 'Home Depot';
			$supplier->address = '123 Supplier St NW Calgary';
			$supplier->phone = '403-123-1234';
			$supplier->email = 'homedepot@gmail.com';
			$supplier->contactName = 'John Doe';
			$supplier->save();

            $equipment = new Equipment();
            $equipment->name = 'Drill';
			$equipment->cost = 700;
			$equipment->lastMaintenance = '02/10/2019';
            $equipment->maintenanceFreq = 'Once per year';
			$equipment->supplierID = 1;
			$equipment->userSIN = $carmen->SIN;
			$equipment->save();

			$equipment = new Equipment();
			//an-unrented equipment
			$equipment->name = 'Lawnmower';
            $equipment->cost = 630;
            $equipment->maintenanceFreq = 'Bi-Monthly';
			$equipment->supplierID = 1;
			$equipment->save();
			
			$equipment = new Equipment();
            $equipment->name = 'Hydraulic Press';
			$equipment->cost = 2000;
			$equipment->lastMaintenance = '01/04/2019';
            $equipment->maintenanceFreq = 'Semi-Annualy';
            $equipment->supplierID = 1;
			$equipment->save();
			
			$supplier = new Supplier();
			$supplier->name = 'Rona';
			$supplier->address = '123 Rona Way SE, Calgary';
			$supplier->phone = '403-869-1234';
			$supplier->email = 'rona@gmail.com';
			$supplier->contactName = 'Tommy Rona';
			$supplier->save();

			$equipment = new Equipment();
			//an-unrented equipment
            $equipment->name = 'Forklift';
            $equipment->cost = 5900;
            $equipment->maintenanceFreq = 'Semi-Annually';
			$equipment->supplierID = 2;
			$equipment->save();

            $equipment = new Equipment();
            $equipment->name = 'Pneumatic Engraver';
			$equipment->cost = 1350;
			$equipment->lastMaintenance = '01/19/2018';
			$equipment->maintenanceFreq = 'Monthly';
			$equipment->userSIN = $carmen->SIN;
            $equipment->supplierID = 2;
			$equipment->save();

			$ts = new Timesheet();
			$ts->SIN = $carmen->SIN;
			$ts->month = 4;
			$ts->year = 2019;
			$ts->save();

			$ts = new Timesheet();
			$ts->SIN = $carmen->SIN;
			$ts->month = 3;
			$ts->year = 2019;
			$ts->save();

			$ts = new Timesheet();
			$ts->SIN = $ross->SIN;
			$ts->month = 4;
			$ts->year = 2019;
			$ts->save();

			$ts = new Timesheet();
			$ts->SIN = $ross->SIN;
			$ts->month = 3;
			$ts->year = 2019;
			$ts->save();

			$s = new Shift();
			$s->SIN = $ross->SIN;
			$s->startTime = 9;
			$s->endTime = 15;
			$s->day = 10;
			$s->month = 4;
			$s->year = 2019;
			$s->save();

			$s = new Shift();
			$s->SIN = $ross->SIN;
			$s->startTime = 8;
			$s->endTime = 16;
			$s->day = 9;
			$s->month = 4;
			$s->year = 2019;
			$s->save();

			$s = new Shift();
			$s->SIN = $carmen->SIN;
			$s->startTime = 7;
			$s->endTime = 15;
			$s->day = 1;
			$s->month = 4;
			$s->year = 2019;
			$s->save();

			$s = new Shift();
			$s->SIN = $carmen->SIN;
			$s->startTime = 10;
			$s->endTime = 18;
			$s->day = 2;
			$s->month = 3;
			$s->year = 2019;
			$s->save();

			$pn = new EmployeePhone();
			$pn->SIN = 123456789;
			$pn->phone = 4031234567;
			$pn->save();

            $pn = new EmployeePhone();
            $pn->SIN = 123456789;
            $pn->phone = 4039876543;
            $pn->save();

            $pn = new EmployeePhone();
            $pn->SIN = 987654321;
            $pn->phone = 4031234444;
            $pn->save();

            $pn = new EmployeePhone();
            $pn->SIN = 123456789;
            $pn->phone = 4039876666;
            $pn->save();


		}

		
}
