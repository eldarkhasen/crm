<?php

namespace App\Http\Controllers;

use App\CashBox;
use App\CashFlow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashBoxController extends Controller
{
    /**
     * CashBoxController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth','hasPerToFinance']);
    }

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

        $cashBox = CashBox::create([
            'name'=>$request->name,
            'initial_balance'=>$request->initial_balance,
            'current_balance'=>$request->initial_balance
        ]);
        $time = strtotime(str_replace('/', '-',$cashBox->created_at));
        $newformat = date('Y-m-d',$time);
        $cashflow = CashFlow::create([
            'cash_flow_date'=>$newformat,
            'payment_item_id'=>4,
            'cash_box_id'=>$cashBox->id,
            'user_created_id'=>Auth::user()->id,
            'amount'=>$request->initial_balance,
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
