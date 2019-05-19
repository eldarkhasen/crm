<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\CashBox;
use App\CashFlow;
use App\Employee;
use App\Patient;
use App\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        try {
            $appoint = new Appointment();
            $appoint->title = $request->title;
            $appoint->start = $request->start;
            $appoint->end = $request->end;
            $appoint->employee_id = $request->employee_id;

            if (isset($request->patient_id)) {
                $appoint->patient_id = $request->patient_id;
            } else {
                $patient = Patient::where('name', $request->patient['name'])
                    ->where('surname', $request->patient['surname'])
                    ->where('phone', $request->patient['phone'])
                    ->where('birth_date', $request->patient['birthdate'])
                    ->first();

                if (empty($patient)) {
                    $patient = new Patient();
                    $patient->name = $request->patient['name'];
                    $patient->surname = $request->patient['surname'];
                    $patient->patronymic = $request->patient['patronymic'];
                    $patient->phone = $request->patient['phone'];
                    $patient->email = $request->patient['email'];
                    $patient->address = $request->patient['address'] ?? null;
                    $patient->birth_date = $request->patient['birthdate'];
                    $patient->gender = $request->patient['gender'];
                    $patient->save();
                }

                $appoint->patient_id = $patient->id;
            }


            $appoint->price = $request->price;
            $appoint->status = $request->status;
            $appoint->status_comment = $request->status_comment ?? null;


            if(isset($patient->email)){
                $name = $request->patient['name'];
                $to_email = $request->patient['email'];
                $from_email = env('MAIL_USERNAME');

                $employee = Employee::findOrFail($request->employee_id);

                $data = ['appointment' => $request, 'employee' => $employee];
                Mail::send('emails.appointmentdetails', $data, function($message) use ($from_email, $to_email, $name) {
                    $message->to($to_email, $name)->subject
                    ('Aisadent. Детали записи');
                    $message->from($from_email,'Aisadent');
                });
            }

            $appoint->save();

            $services = [];
            foreach ($request->services as $service)
                array_push($services, $service['id']);

            if (!empty($request->services)) {
                $appoint->services()->attach($services);
            }

            return response()->json([
                'id' => $appoint->id,
                'success' => true
            ]);
        }catch (Exception $e){
            $error_message = null;
            $error_text = null;

            if(strpos($e->getMessage(), "key 'patients_phone_unique'") !== false){
                $error_message = "Номер телефона " . $request->patient['phone'] . " уже зарегестрирован у другого пациента.\n";
            }

            if(strpos($e->getMessage(), "key 'patients_email_unique'") !== false){
                $error_message = $error_message . "Электронная почта " . $request->patient['email'] . " уже зарегестрирована у другого пациента.\n";
            }

            if($error_message == null){
                $error_text = $e->getMessage();
                $error_message = "Ошибка на сервере";

            }

            return response()->json([
                'error' => $error_message,
                'success' => false,
                'error_text' => $error_text
            ]);
        }
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

        $cashbox_success = null;

        if( $appoint->status === "success" ){

            $cashBox = CashBox::first();

            $cashflow = CashFlow::create([
                'cash_flow_date'=>date('Y-m-d'),
                'payment_item_id'=>\StaticPaymentItems::$paymentItems['services'],
                'cash_box_id'=>$cashBox->id,
                'employee_id'=>$request->employee_id,
                'patient_id'=>$request->patient_id,
                'user_created_id'=>Auth::user()->id,
                'amount'=>$request->price,
                'comments'=>"Оплата записи"
            ]);

            if(isset($cashflow)){
                $cashBox->current_balance = $cashBox->current_balance + intval($request->price);
                $cashBox->income = $cashBox->income + intval($request->price);
                $cashBox->save();

                $cashbox_success = true;
            }else{
                $cashbox_success = false;
            }

        }

        return response()->json([
            'success' => $success,
            'cashbox_success' => $cashbox_success]);
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
