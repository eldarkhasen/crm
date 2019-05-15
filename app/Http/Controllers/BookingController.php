<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(){
        return view('booking.index');
    }

    // get pending appointments of employee
    public function getAppointments($employee_id){
        return response()->json(['appointments' => Appointment::where('employee_id', $employee_id)
            ->where('status', 'pending')
            ->get()]);
    }

    public function getBusyHours(Request $request){
        $busyHours = [];
        $appointments = Appointment::where('employee_id', $request->employee_id)
            ->where('status', 'pending')
            ->get();

        foreach ($appointments as $appointment) {
            if(date('Y-m-d', strtotime($appointment->start)) === date('Y-m-d', strtotime($request->date))){

                $startHour = intval(date('H', strtotime($appointment->start)));
                $endHour = intval(date('H', strtotime($appointment->end)));
                array_push($busyHours, $startHour);

                if( $endHour > $startHour ){
                    for ($i = $startHour + 1; $i <= $endHour; $i++){
                        array_push($busyHours, $i);
                    }
                }

            }
        }

//        TODO: в зависимости от рабочего графика сотрудника, высчитывать нерабочие часы, пока по дефолту до 9 утра и после 6 вечера

        for($i = 0; $i < 9; $i++){
            array_push($busyHours, $i);
        }

        for($i = 18; $i < 24; $i++){
            array_push($busyHours, $i);
        }

        return response()->json([
            'busyHours' => $busyHours
        ]);
    }
}
