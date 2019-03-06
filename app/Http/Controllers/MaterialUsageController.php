<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Material;
use App\MaterialUsage;
use Illuminate\Http\Request;

class MaterialUsageController extends Controller
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
        $materials = Material::all();
        $employees = Employee::all();
        return view('materialsUsages.create',compact('materials','employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputQuantity = $request->quantity;
        $quantityOnStore = $request->quantity_on_store;
        $comments = $request->comments;
        if(!isset($comments)){
            $comments = "нет коментариев";
        }
        if($inputQuantity>$quantityOnStore){
            $notification = array(
                'message' => 'Неверное количество',
                'alert-type' => 'error'
            );
            return redirect()->route('materialsUsages.create')
                ->with($notification);
        }

        $usage = MaterialUsage::create([
            'material_id'=>$request->material_id,
            'employee_id'=>$request->employee_id,
            'count'=>$inputQuantity,
            'comments'=>$comments
        ]);

        $material = Material::findOrFail($request->material_id);
        $material->quantity = $material->quantity-$inputQuantity;


//        $usage->material()->save($material);
        $material->save();
        $notification = array(
            'message' => 'Все ок!',
            'alert-type' => 'success'
        );
        return redirect()->route('materials.index')
            ->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaterialUsage  $materialUsage
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialUsage $materialUsage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaterialUsage  $materialUsage
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialUsage $materialUsage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialUsage  $materialUsage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialUsage $materialUsage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaterialUsage  $materialUsage
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialUsage $materialUsage)
    {
        //
    }
}
