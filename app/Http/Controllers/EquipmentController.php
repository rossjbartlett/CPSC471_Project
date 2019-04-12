<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Http\Requests\EquipmentRequest;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('manager', ['only' => 'create', 'only' => 'edit', 'only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currently_renting=[];
        if(Auth::user()->isManager())
            $equipment = Equipment::orderBy('name')->get();
        else {
            $equipment = Equipment::where('userSIN', null)->orderBy('name')->get();
            $currently_renting = Equipment::where('userSIN', Auth::user()->SIN)->orderBy('name')->get();
        }

        return view('equipment.index', compact('equipment', 'currently_renting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $select = [];
        foreach($suppliers as $s)
            $select[$s->id] = $s->name;
        return view('equipment.create', compact('select'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentRequest $request)
    {
        $equipment = new Equipment();
        $equipment->name = $request->input('name');
        $equipment->cost = $request->input('cost');
        $equipment->maintenanceFreq = $request->input('maintenanceFreq');
        $equipment->supplierID = $request->input('supplierID');
        $equipment->save();
        return redirect('equipment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!ctype_digit($id)){ // string consists of all digs, thus is an int
            abort(404);
        }

        $equipment = Equipment::findOrFail($id);
        // the 'findOrFail' basically does this: if(is_null($book)) abort(404);

        $supplier = $equipment->supplier();

        $renter = null;

        if($equipment->user())
            $renter = $equipment->user();

        return view('equipment.show', compact( 'equipment', 'supplier', 'renter')); // compact() replaces with()
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        $suppliers = Supplier::all();
        $select = [];
        foreach($suppliers as $s)
            $select[$s->id] = $s->name;

        return view ('equipment.edit', compact('equipment', 'select'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentRequest $request, Equipment $equipment)
    {
        $equipment->update([
            'name' => $request->input('name'),
            'cost' => $request->input('cost'),
            'maintenanceFreq' => $request->input('maintenanceFreq'),
            'supplierID' => $request->input('supplierID'),
        ]);
        return redirect('equipment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Equipment::findOrFail($id)->delete();

        return redirect('equipment');
    }

    public function rent($id){
        $equipment = Equipment::find($id);
        $equipment->userSIN = Auth::user()->SIN;
        $equipment->save();
        return redirect('equipment');
    }

    public function return($id){
        $equipment = Equipment::find($id);
        $equipment->userSIN = null;
        $equipment->save();
        return redirect('equipment');
    }
}
