<?php

namespace App\Http\Controllers;

use App\Material;
use App\MaterialUsage;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * MaterialController constructor.
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
        $materials = Material::all();
        $materialsUsages = MaterialUsage::all();
//        dd($materialsUsages->material->name);
        return view('materials.index',compact('materials','materialsUsages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materials.create');
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
            'price'=>'required',
            'quantity'=>'required',
            'producer'=>'required'
        ]);

        Material::create([
            'name'=> $request->name,
            'quantity'=>$request->quantity,
            'measure_unit'=>$request->measure_unit,
            'producer'=>$request->producer,
            'price'=>$request->price,
            'description'=>$request->description
        ]);

        $notification = array(
            'message' => 'Товар добавлен',
            'alert-type' => 'success'
        );

        return redirect()->route('materials.index')
            ->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        return view('materials.edit',compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Material $material
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Material $material)
    {
        $this->validate($request, [
            'name'=>'required|max:120',
            'price'=>'required',
            'quantity'=>'required',
            'producer'=>'required'
        ]);

        $input = $request->all();
        $material->fill($input)->save();

        $notification = array(
            'message' => 'Товар обновлен',
            'alert-type' => 'success'
        );

        return redirect()->route('materials.index')
            ->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
    }
}
