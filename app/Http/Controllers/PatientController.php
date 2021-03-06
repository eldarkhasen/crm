<?php

namespace App\Http\Controllers;

use App\Patient;
use App\XrayImage;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class PatientController extends Controller
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
            'phone'=>'required',
            'birth_date'=>'required',
            'discount'=>'required'
        ]);

        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension();
            Storage::disk('public')->put($photo->getFilename().'.'.$extension,File::get($photo));
            $patient = Patient::create([
                'name'=>request()->name,
                'surname'=>request()->surname,
                'patronymic'=>request()->patronymic,
                'phone'=>request()->phone,
                'birth_date'=>request()->birth_date,
                'gender'=> request()->gender,
                'id_card'=>request()->id_card,
                'id_number'=>request()->id_number,
                'address'=>request()->address,
                'city'=>request()->city,
                'workplace'=>request()->workplace,
                'position'=>request()->position,
                'discount'=>request()->discount,
                'nationality'=>request()->nationality,
                'photoname'=>$photo->getFilename().'.'.$extension,
                'mime'=>$photo->getClientMimeType(),
                'original_photoname'=>$photo->getClientOriginalExtension()

            ]);
        }else{
            $patient = Patient::create([
                'name'=>request()->name,
                'surname'=>request()->surname,
                'patronymic'=>request()->patronymic,
                'phone'=>request()->phone,
                'birth_date'=>request()->birth_date,
                'gender'=> request()->gender,
                'id_card'=>request()->id_card,
                'id_number'=>request()->id_number,
                'address'=>request()->address,
                'city'=>request()->city,
                'workplace'=>request()->workplace,
                'position'=>request()->position,
                'nationality'=>request()->nationality,
                'discount'=>request()->discount,
            ]);
        }

        $notification = array(
            'message' => 'Пациент добавлен!',
            'alert-type' => 'success'
        );

        if(request()->newPatient == 1){
            return response()->json(['patient' => $patient]);
        }else{
            return redirect()->route('patients.index')
                ->with($notification);
        }
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
        $sumOfServices = 0;
        foreach ($patient->appointments as $appointment){
            if($appointment->status=="success"){
                $sumOfServices = $sumOfServices+$appointment->price;
            }
        }

        return view('patients.show',compact('patient','sumOfServices'));
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
            'discount'=>'required'
        ]);

        $patient->fill([
            'name'=>request()->name,
            'surname'=>request()->surname,
            'patronymic'=>request()->patronymic,
            'phone'=>request()->phone,
            'birth_date'=>request()->birth_date,
            'gender'=> $gender[request()->gender],
            'id_card'=>request()->id_card,
            'id_number'=>request()->id_number,
            'address'=>request()->address,
            'city'=>request()->city,
            'workplace'=>request()->workplace,
            'position'=>request()->position,
            'nationality'=>request()->nationality,
            'discount'=>request()->discount
        ])->save();

        $notification = array(
            'message' => 'Пациент обновлен!',
            'alert-type' => 'success',
            'tab'=>'default'
        );
        return redirect()->route('patients.index')
            ->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patients
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        $notification = array(
            'message' => 'Пациент удален',
            'alert-type' => 'info'
        );
        return redirect()->route('patients.index')
            ->with($notification);
    }

    public function get(){
        return response()->json(['patients' => Patient::all()]);
    }
}
