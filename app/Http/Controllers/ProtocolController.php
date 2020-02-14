<?php

namespace App\Http\Controllers;

use App\Protocol;
use Illuminate\Http\Request;

class ProtocolController extends Controller
{

    /**
     * ProtocolController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $protocols = Protocol::all();
        return view('protocols.index',compact('protocols'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('protocols.create');
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
        $this->validate($request, [
            'name'=>'required|max:120',
            'patient_problems'=>'required',
            'anamnesis_vitae'=>'required',
            'anamnesis_morbi'=>'required',
            'visual_inspection'=>'required',
            'bite'=>'required',
            'objective_data'=>'required',
            'xray_data'=>'required',
            'diagnosis'=>'required',
            'treatment_plan'=>'required',
            'work_done'=>'required',
            'recommendations'=>'required',
        ]);

        Protocol::create([
            "name"=>$request->name,
            "patient_problems"=>$request->patient_problems,
            "anamnesis_vitae"=>$request->anamnesis_vitae,
            "anamnesis_morbi"=>$request->anamnesis_morbi,
            "visual_inspection"=>$request->visual_inspection,
            "bite"=>$request->bite,
            "objective_data"=>$request->objective_data,
            "xray_data"=>$request->xray_data,
            "diagnosis"=>$request->diagnosis,
            "treatment_plan"=>$request->treatment_plan,
            "work_done"=>$request->work_done,
            "recommendations"=>$request->recommendations
        ]);

        $notification = array(
            'message' => 'Протокол добавлен',
            'alert-type' => 'success'
        );

        return redirect()->route('protocols.index')
            ->with($notification);


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $protocol = Protocol::findOrFail($id);
        return view('protocols.edit',compact('protocol'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $protocol = Protocol::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:120',
            'patient_problems'=>'required',
            'anamnesis_vitae'=>'required',
            'anamnesis_morbi'=>'required',
            'visual_inspection'=>'required',
            'bite'=>'required',
            'objective_data'=>'required',
            'xray_data'=>'required',
            'diagnosis'=>'required',
            'treatment_plan'=>'required',
            'work_done'=>'required',
            'recommendations'=>'required',
        ]);

        $input = $request->all();
        $protocol->fill($input)->save();

        $notification = array(
            'message' => 'Протокол обновлен',
            'alert-type' => 'info'
        );

        return redirect()->route('protocols.index')
            ->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $protocol = Protocol::findOrFail($id);
        $protocol->delete();

        $notification = array(
            'message' => 'Протокол удален',
            'alert-type' => 'info'
        );

        return redirect()->route('protocols.index')
            ->with($notification);
    }

    public function getAllProtocols(){
        return response()->json(["protocols" => Protocol::all()]);
    }
}
