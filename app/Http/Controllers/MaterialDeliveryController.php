<?php

namespace App\Http\Controllers;

use App\Material;
use App\MaterialDelivery;
use Illuminate\Http\Request;

class MaterialDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveries = MaterialDelivery::all();
        return view("materialsDeliveries.index",compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = Material::all();
        return view("materialsDeliveries.create",compact('materials'));
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
            'material_id'=>'required',
            'invoice_number'=>'required',
        ]);
        $inputQuantity = $request->quantity;
        $comments = $request->comments;

        if(!isset($comments)){
            $comments = "нет коментариев";
        }
        
        $date = date('Y/m/d');

        MaterialDelivery::create([
            'material_id'=>$request->material_id,
            'quantity'=>$inputQuantity,
            'comments'=>$comments,
            'delivery_date'=>$date,
            'invoice_number'=>$request->invoice_number
        ]);

        $material = Material::findOrFail($request->material_id);
        $material->quantity = $material->quantity+$inputQuantity;
        $material->save();
        $notification = array(
            'message' => 'Все ок!',
            'alert-type' => 'success'
        );
        return redirect()->route('materialsDeliveries.index')
            ->with($notification);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaterialDelivery  $materialDelivery
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialDelivery $materialDelivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaterialDelivery  $materialDelivery
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialDelivery $materialDelivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialDelivery  $materialDelivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialDelivery $materialDelivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaterialDelivery  $materialDelivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialDelivery $materialDelivery)
    {
        //
    }
}
