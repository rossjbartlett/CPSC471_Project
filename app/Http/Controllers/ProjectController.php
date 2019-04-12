<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\BudgetItem;
use App\WorksOn;

use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

      $this->middleware('manager', ['only'=>'store', 'only'=>'edit', 'only'=>'create', 'only'=>'destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth()->User()->isManager())
            $projs = Project::orderby('id')->get();     //get all
        else
            $projs = Auth()->User()->projects();     //get only projects they work on
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
     * @param  \Http\Requests\ProjectRequest $request
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
        $current_user = Auth()->User();
        if(!$current_user->isManager() && !$current_user->isWorkingOn($project->id)){
            //if not manager, only allow users to see their own department
            return redirect('home');
        }

        $budgetItems  = $project->budgetItems();

        // $employees  = $project->users();
        $employees_hours = $project->employee_hours();

        $net = 0;
        foreach($budgetItems as $b){
            $net += $b->value;
        }
        // dd($employees_hours);
        return view('projects.show', compact('project', 'employees_hours', 'budgetItems','net')); // compact() replaces with()    }
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
    public function destroy($id)
    {
        $p = Project::findOrFail($id);
        $u = $p->users();
        if(!empty($u)){
            WorksOn::where('projectID',$id)->delete();
        }
        $p->delete();
        return redirect('projects');
    }
}
