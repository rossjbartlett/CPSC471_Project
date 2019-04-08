<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Http\Requests\EquipmentRequest;
use Illuminate\Http\Request;

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
        $equipment = Equipment::orderBy('name')->get();
        return view('equipment.index')->with('equipment', $equipment);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equipment.create');
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
        $equipment->maintenanceFreq = $request->input('maintenanceFrequency');
        $equipment->supplierID = $request->input('supplierId');
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
        return view ('equipment.edit', compact('equipment'));

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
        //
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
}
