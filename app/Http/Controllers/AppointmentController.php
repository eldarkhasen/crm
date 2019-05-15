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
        $this->middleware('auth', ['except' => ['store']]);
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

        if(isset($request->patient_id)){
            $appoint->patient_id = $request->patient_id;
        }
        else{
            $patient = Patient::where('name', $request->patient['name'])
                ->where('surname', $request->patient['surname'])
                ->where('phone', $request->patient['phone'])
                ->where('birth_date', $request->patient['birthdate'])
                ->first();

            if(empty($patient)){
                $patient = new Patient();
                $patient->name = $request->patient['name'];
                $patient->surname = $request->patient['surname'];
                $patient->patronymic = $request->patient['patronymic'];
                $patient->phone = $request->patient['phone'];
                $patient->email = $request->patient['email'];
                $patient->address = $request->patient['address'];
                $patient->birth_date = $request->patient['birthdate'];
                $patient->gender = $request->patient['gender'];
                $patient->save();
            }

            $appoint->patient_id = $patient->id;
        }


        $appoint->price = $request->price;
        $appoint->status = $request->status;
        $appoint->status_comment = $request->status_comment;
        $appoint->save();

        $services = [];
        foreach ($request->services as $service)
            array_push($services, $service['id']);

        if(!empty($request->services)){
            $appoint->services()->attach($services);
        }

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
        $appoint->patient_id = $request->patient_id;
        $appoint->price = $request->price;
        $appoint->status = $request->status;
        $appoint->status_comment = $request->status_comment;
        $success = $appoint->save();

        $services = [];
        foreach ($request->services as $service)
            array_push($services, $service['id']);

        if(!empty($request->services)){
            $appoint->services()->sync($services, false);
        }

        // TODO: редактирование cashflow

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
        return response()->json(['appointments' => Appointment::with(['services', 'patient'])->get()]);
    }
}
