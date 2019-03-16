<?php

namespace App\Http\Controllers;

use App\PaymentItem;
use Illuminate\Http\Request;

class PaymentItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentItems = PaymentItem::latest()->get();
        return view('paymentitems.index',compact('paymentItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'payment_type_id'=>'required'
        ]);

        PaymentItem::create([
            'name'=>$request->name,
            'payment_type_id'=>$request->payment_type_id
        ]);

        $notification = array(
            'message' => 'Статья добавлена',
            'alert-type' => 'success'
        );

        return redirect()->route('paymentItems.index')
            ->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentItem  $paymentItem
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentItem $paymentItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentItem  $paymentItem
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentItem $paymentItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentItem  $paymentItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentItem $paymentItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentItem  $paymentItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentItem $paymentItem)
    {
        //
    }
}
