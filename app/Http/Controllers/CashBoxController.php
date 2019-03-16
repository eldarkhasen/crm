<?php

namespace App\Http\Controllers;

use App\CashBox;
use Illuminate\Http\Request;

class CashBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashBoxes = CashBox::latest()->get();
        return view('cashboxes.index',compact('cashBoxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cashboxes.create');
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
            'name'=>'required',
            'initial_balance'=>'required'
        ]);

        CashBox::create([
            'name'=>$request->name,
            'initial_balance'=>$request->initial_balance,
            'current_balance'=>$request->initial_balance
        ]);

        $notification = array(
            'message' => 'Касса добавлена',
            'alert-type' => 'success'
        );

        return redirect()->route('cashBoxes.index')
            ->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CashBox  $cashBox
     * @return \Illuminate\Http\Response
     */
    public function show(CashBox $cashBox)
    {
        return view('cashboxes.show',compact('cashBox'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CashBox  $cashBox
     * @return \Illuminate\Http\Response
     */
    public function edit(CashBox $cashBox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CashBox  $cashBox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashBox $cashBox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CashBox  $cashBox
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashBox $cashBox)
    {
        //
    }
}
