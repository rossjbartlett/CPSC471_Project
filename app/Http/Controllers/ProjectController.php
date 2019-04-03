<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\BudgetItem;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{

    public function __construct()
    {
      $this->middleware('manager', ['only'=>'store', 'only'=>'edit', 'only'=>'create']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $projs = Project::orderby('id')->get();     //get all
        return view('projects.index')->with('projects', $projs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');

    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\BookRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project  = new Project();
        $project->name = $request->input('name');
        $project->budget = $request->input('budget');
        $project->deptID = $request->input('deptID');
        $project->save();
        return redirect('projects');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $budgetItems  = $project->budgetItems();

        // $employees  = $project->users();
        $employees_hours = $project->employee_hours();
        // dd($employees_hours);
        return view('projects.show', compact('project', 'employees_hours', 'budgetItems')); // compact() replaces with()    }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view ('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update([
            'name' => $request->input('name'),
            'budget' => $request->input('budget'),
            'deptID' => $request->input('deptID'),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return redirect('projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
