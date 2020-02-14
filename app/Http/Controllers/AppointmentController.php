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
            $emp = Employee::findOrFail($request->employee_id);
            $appoint->color = $emp->color;
            $appoint->active = $request->active;

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
            $appoint->patient_problems=$request->patient_problems ?? null;
            $appoint->diagnosis=$request->diagnosis ?? null;
            $appoint->work_done=$request->work_done ?? null;
            $appoint->anamnesis_vitae=$request->anamnesis_vitae ?? null;
            $appoint->anamnesis_morbi=$request->anamnesis_morbi ?? null;
            $appoint->visual_inspection=$request->visual_inspection ?? null;
            $appoint->xray_data=$request->xray_data ?? null;
            $appoint->bite=$request->bite ?? null;
            $appoint->recommendations=$request->recommendations ?? null;
            $appoint->treatment_plan=$request->treatment_plan ?? null;
            $appoint->objective_data=$request->objective_data ?? null;
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
        return view('appointments.show',compact('appointment'));
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
        $appoint->color = $request->color;
        $appoint->patient_problems=$request->patient_problems;
        $appoint->diagnosis=$request->diagnosis;
        $appoint->anamnesis_vitae=$request->anamnesis_vitae;
        $appoint->anamnesis_morbi=$request->anamnesis_morbi;
        $appoint->visual_inspection=$request->visual_inspection;
        $appoint->work_done=$request->work_done;
        $appoint->bite=$request->bite;
        $appoint->active = $request->active;
        $appoint->xray_data=  $request->xray_data;
        $appoint->recommendations=$request->recommendations;
        $appoint->treatment_plan=$request->treatment_plan;
        $appoint->objective_data=$request->objective_data;
        if($request->status === "pending"){
            $emp = Employee::findOrFail($request->employee_id);
            $appoint->color = $emp->color;
        }
        $success = $appoint->save();
        $patient = Patient::findOrFail($request->patient_id);
        $patient->anamnesis_vitae = $request->anamnesis_vitae;
        $patient->save();

        $services = [];
        foreach ($request->services as $service)
            array_push($services, $service['id']);

        if(!empty($request->services)){
            $appoint->services()->sync($services, false);
        }

        $cashbox_success = null;

        if($appoint->status === "success"){
            $cashBox = CashBox::first();
            $cashflow = CashFlow::where('appointment_id','=',$appoint->id)->first();
            if(isset($cashflow)){
                if($cashflow->amount!=$request->price) {

                    $cashBox->current_balance = $cashBox->current_balance + (intval($request->price)-intval($cashflow->amount));
                    $cashBox->income = $cashBox->income + (intval($request->price)-intval($cashflow->amount));
                    $cashBox->save();

                    if($cashflow->amount<$request->price){
                        $cashflow->comments= "Запись была обновлена. Цена была повышена на: ".(intval($request->price)-intval($cashflow->amount))."тг";
                    }else{
                        $cashflow->comments= "Запись была обновлена. Цена была снижена на: ".(intval($request->price)-intval($cashflow->amount))."тг";
                    }

                    $cashflow->amount = $request->price;
                    $cashflow->save();
                    $cashbox_success = true;
                }
            }else{
                $cashflow = CashFlow::create([
                    'cash_flow_date'=>date('Y-m-d'),
                    'payment_item_id'=>\StaticPaymentItems::$paymentItems['services'],
                    'cash_box_id'=>$cashBox->id,
                    'employee_id'=>$request->employee_id,
                    'patient_id'=>$request->patient_id,
                    'user_created_id'=>Auth::user()->id,
                    'amount'=>$request->price,
                    'comments'=>"Оплата записи",
                    "appointment_id"=>$appoint->id
                ]);
                $cashBox->current_balance = $cashBox->current_balance+$request->price;
                $cashBox->income = $cashBox->income+$request->price;
                $cashBox->save();
                $cashbox_success = true;
            }

//            if(isset($cashflow)){
//                $cashbox_success = true;
//            }else{
//                $cashbox_success = false;
//            }

        }else if($appoint->status === "client_miss"){
            $cashBox = CashBox::first();
            $cashflow = CashFlow::where('appointment_id','=',$appoint->id)->first();
            $cashBox->current_balance = $cashBox->current_balance-$cashflow->amount;
            $cashBox->income = $cashBox->income-$cashflow->amount;
            $cashflow->amount = 0;
            $cashflow->comments = "Клиент не пришел!";
            $cashflow->save();
            $cashBox->save();
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
