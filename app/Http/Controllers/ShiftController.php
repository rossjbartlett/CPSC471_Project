<?php

namespace App\Http\Controllers;

use App\Shift;
use App\Timesheet;
use Illuminate\Http\Request;

class ShiftController extends Controller
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
    public function create()
    {
        return view('shifts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shift = new Shift();
        
        $date = \Carbon\Carbon::parse($request->input('date')); //parsing date
        $shift->year = $date->year;
        $shift->month = $date->month;
        $shift->day = $date->day;
        
        $time = \Carbon\Carbon::parse($request->input('starttime')); //getting hour of start time
        $shift->startTime = $time->hour;
        
        $time = \Carbon\Carbon::parse($request->input('endtime')); //getting hour of end time 
        $shift->endTime = $time->hour;
        
        if ($shift->startTime > $shift->endTime) {
            return redirect('shifts/create');
        }
    
        $shift->SIN = Auth()->User()->SIN; //getting user SIN
        
        
        $timesheet = Auth()->User()->timesheets()->where('year','=',$shift->year)->where('month','=',$shift->month); 
        

        if ($timesheet->isEmpty()) { 
            Timesheet::create([
                'SIN' => $shift->SIN,
                'month' => $shift->month,
                'year' => $shift->year
            ]);
        } 
        $shift->save();
    
        return redirect('timesheets');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        if ((Auth()->User()->SIN == $shift->SIN) || Auth()->User()->isManager()) {
            $startTime = $shift->startTime; 
            $endTime = $shift->endTime;

            if ($startTime > 12) {
                $startTime -= 12;
                $startTime .= " PM";
            } else {
                $startTime .= " AM";
            }

            if ($endTime > 12) {
                $endTime -= 12;
                $endTime .= " PM";
            } else {
                $endTime .= " AM";
            }

            return view('shifts.show', compact('shift', 'startTime', 'endTime'));
        } else {
            return redirect('timesheets');  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        //
    }
}
