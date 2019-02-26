<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Employee;
use App\Patient;
use App\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $appointments = Appointment::all();
        $employees = Employee::all();
        $services = Service::all();
        $patients = Patient::all();

        return view('appointments.index', compact('appointments', 'employees', 'services', 'patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $appoint = new Appointment();
        $appoint->title = $request->title;
        $appoint->start = $request->start;
        $appoint->end = $request->end;
        $appoint->employee_id = $request->employee_id;
        $appoint->service_id = $request->service_id;
        $appoint->patient_id = $request->patient_id;
        $appoint->save();

        return response()->json(['id' => $appoint->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $appoint = Appointment::findOrFail($request->id);
        $appoint->title = $request->title;
        $appoint->start = $request->start;
        $appoint->end = $request->end;
        $appoint->employee_id = $request->employee_id;
        $appoint->service_id = $request->service_id;
        $appoint->patient_id = $request->patient_id;
        $success = $appoint->save();
        return response()->json(['success' => $success]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appoint = Appointment::findOrFail($id);
        $success = $appoint->delete();
        return response()->json(['success' => $success]);
    }

    public function get(){
        return response()->json(['appointments' => Appointment::all()]);
    }
}
