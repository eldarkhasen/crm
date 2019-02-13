<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $gender=[
            '1' => 'Не указано',
            '2' => 'Мужской',
            '3' => 'Женский'
        ];

        $this->validate($request, [
            'name'=>'required|max:120',
            'surname'=>'required|max:120',
            'patronymic'=>'required|max:120',
            'phone'=>'required|',
            'birth_date'=>'required',
            'discount'=>'required',
            'email'=>'required|email|unique:patients'
        ]);

        Patient::create([
            'name'=>request()->name,
            'surname'=>request()->surname,
            'patronymic'=>request()->patronymic,
            'phone'=>request()->phone,
            'email'=>request()->email,
            'birth_date'=>request()->birth_date,
            'gender'=> $gender[request()->gender],
            'id_card'=>request()->id_card,
            'id_number'=>request()->id_number,
            'address'=>request()->address,
            'city'=>request()->city,
            'discount'=>request()->discount
        ]);
        $notification = array(
            'message' => 'Пациент добавлен!',
            'alert-type' => 'success'
        );
        return redirect()->route('patients.index')
            ->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patients
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.show',compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patients
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit',compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Patient $patients
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $gender=[
            '1' => 'Не указано',
            '2' => 'Мужской',
            '3' => 'Женский'
        ];

        $this->validate($request, [
            'name'=>'required|max:120',
            'surname'=>'required|max:120',
            'patronymic'=>'required|max:120',
            'phone'=>'required|',
            'birth_date'=>'required',
            'discount'=>'required',
            'email' => 'required|unique:patients,email,'.$id
        ]);

        $patient->fill([
            'name'=>request()->name,
            'surname'=>request()->surname,
            'patronymic'=>request()->patronymic,
            'phone'=>request()->phone,
            'email'=>request()->email,
            'birth_date'=>request()->birth_date,
            'gender'=> $gender[request()->gender],
            'id_card'=>request()->id_card,
            'id_number'=>request()->id_number,
            'address'=>request()->address,
            'city'=>request()->city,
            'discount'=>request()->discount
        ])->save();
        return redirect()->route('patients.index')
            ->with('flash_message',
                'Patient successfully added.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patients)
    {
        //
    }
}
