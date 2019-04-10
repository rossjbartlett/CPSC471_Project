<?php

namespace App\Http\Controllers;

use App\BudgetItem;
use App\Project;

use Illuminate\Http\Request;

class BudgetItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $r)
    {
        $projectID = $r->input('projectID');
        // dd($projectID);
        // dd($project);
        // abort(404);
        //todo need to get project
        return view('budgetItems.create', compact('projectID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $b = new BudgetItem();
        // dd($request);
        $b->projectID = $request->input('projectID'); //TODO 
        $b->name = $request->input('name');
        $b->date = $request->input('date');
        $b->value = $request->input('value');
        $b->description = $request->input('description');
        $b->save();
        return redirect('projects/'.$request->input('projectID'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BudgetItem  $budgetItem
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetItem $budgetItem)
    {
        $project  = $budgetItem->project();
        // dd($project);
        return view('budgetItems.show', compact('budgetItem', 'project')); // compact() replaces with()
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BudgetItem  $budgetItem
     * @return \Illuminate\Http\Response
     */
    public function edit(BudgetItem $budgetItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BudgetItem  $budgetItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BudgetItem $budgetItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BudgetItem  $budgetItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetItem $budgetItem)
    {
        //
    }
}
