<?php

namespace App\Http\Controllers;

use App\CashBox;
use App\CashFlow;
use App\PaymentItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashFlowController extends Controller
{
    /**
     * CashFlowController constructor.
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
        $cashFlows = CashFlow::latest()->get();
        return view('cashflows.index',compact('cashFlows'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createIncome()
    {
        $paymentItems = PaymentItem::where("payment_type_id","1")->get();
        $cashBoxes = CashBox::all();
        return view('cashflows.createincome',compact('paymentItems','cashBoxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createExpanse()
    {
        $paymentItems = PaymentItem::where("payment_type_id","2")->get();
        $cashBoxes = CashBox::all();
        return view('cashflows.createexpanse',compact('paymentItems','cashBoxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createIncomeById($id)
    {
        $paymentItems = PaymentItem::where("payment_type_id","1")->get();
        $cashBoxes = CashBox::all();

        return view('cashflows.createincome',compact('paymentItems','cashBoxes','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createExpanseById($id)
    {
        $paymentItems = PaymentItem::where("payment_type_id","2")->get();
        $cashBoxes = CashBox::all();

        return view('cashFlows.createexpanse',compact('paymentItems','cashBoxes','id'));
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeIncome(Request $request)
    {
        $this->validate($request, [
            'cashflow_date'=>'required',
            'cashbox_id'=>'required',
            'payment_item_id'=>'required',
            'amount'=>'required'
        ]);
        $time = strtotime(str_replace('/', '-',$request->cashflow_date));
        $newformat = date('Y-m-d',$time);

        $cashflow = CashFlow::create([
            'cash_flow_date'=>$newformat,
            'payment_item_id'=>$request->payment_item_id,
            'cash_box_id'=>$request->cashbox_id,
            'employee_id'=>$request->employee_id,
            'patient_id'=>$request->patient_id,
            'user_created_id'=>Auth::user()->id,
            'amount'=>$request->amount,
            'comments'=>$request->comments
        ]);

        if(isset($cashflow)){
            $cashBox = CashBox::findOrFail($request->cashbox_id);
            $cashBox->current_balance = $cashBox->current_balance +$request->amount;
            $cashBox->income = $cashBox->income+$request->amount;
            $cashBox->save();

            $notification = array(
                'message' => 'Операция '.$cashflow->paymentItem->name.' произведена',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Ошибка  вышла',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('cashFlows.index')
            ->with($notification);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeExpanse(Request $request)
    {
        $this->validate($request, [
            'cashflow_date'=>'required',
            'cashbox_id'=>'required',
            'payment_item_id'=>'required',
            'amount'=>'required'
        ]);
        $cashBox = CashBox::findOrFail($request->cashbox_id);

        if($cashBox->current_balance<$request->amount){
            $notification = array(
                'message' => 'Пожалуйста, проверьте сумму!',
                'alert-type' => 'error'
            );
            return redirect()->route('cashFlows.index')
                ->with($notification);
        }

        $time = strtotime(str_replace('/', '-',$request->cashflow_date));
        $newformat = date('Y-m-d',$time);

        $cashflow = CashFlow::create([
            'cash_flow_date'=>$newformat,
            'payment_item_id'=>$request->payment_item_id,
            'cash_box_id'=>$request->cashbox_id,
            'employee_id'=>$request->employee_id,
            'patient_id'=>$request->patient_id,
            'user_created_id'=>Auth::user()->id,
            'amount'=>$request->amount,
            'comments'=>$request->comments
        ]);

        if(isset($cashflow)){
            $cashBox->current_balance = $cashBox->current_balance - $request->amount;
            $cashBox->expanse = $cashBox->expanse+$request->amount;
            $cashBox->save();
            $notification = array(
                'message' => 'Операция '.$cashflow->paymentItem->name.' произведена',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Ошибка  вышла',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('cashFlows.index')
            ->with($notification);

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\CashFlow  $cashFlow
     * @return \Illuminate\Http\Response
     */
    public function show(CashFlow $cashFlow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CashFlow  $cashFlow
     * @return \Illuminate\Http\Response
     */
    public function edit(CashFlow $cashFlow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CashFlow  $cashFlow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashFlow $cashFlow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CashFlow  $cashFlow
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashFlow $cashFlow)
    {

    }
}
