<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::all();
        return view('positions.index',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('positions.create');
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
            'name'=>'required|max:120'
        ]);

        Position::create([
            'name'=> $request->name,
            'description'=>$request->description
        ]);

        $notification = array(
            'message' => 'Должность добавлена',
            'alert-type' => 'success'
        );
        return redirect()->route('positions.index')
            ->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = Position::findOrFail($id);
        return view('positions.edit',compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Position $position
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $position = Position::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:120'
        ]);

        $input = $request->all();
        $position->fill($input)->save();

        return redirect()->route('positions.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();
        $notification = array(
            'message' => 'Должность удалена',
            'alert-type' => 'info'
        );
        return redirect()->route('positions.index')
            ->with($notification);
    }

    public function getPositions(){
        return Position::all();
    }
}
