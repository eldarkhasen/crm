<?php

namespace App\Http\Controllers;

use App\CashBox;
use App\CashFlow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashBoxController extends Controller
{
    /**
     * CashBoxController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth','hasPerToFinance'],['except' => ['checkCashBox']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashBoxes = CashBox::latest()->get();
        $cashFlows = CashFlow::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('created_at','desc')->get();
        return view('cashboxes.index',compact('cashBoxes','cashFlows'));
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
            'name'=>'required|unique:cash_boxes',
            'initial_balance'=>'required'
        ]);

        $cashBox = CashBox::create([
            'name'=>$request->name,
            'initial_balance'=>$request->initial_balance,
            'current_balance'=>$request->initial_balance
        ]);
        if($request->initial_balance>0){
            $time = strtotime(str_replace('/', '-',$cashBox->created_at));
            $newformat = date('Y-m-d',$time);

            CashFlow::create([
                'cash_flow_date'=>$newformat,
                'payment_item_id'=>4,
                'cash_box_id'=>$cashBox->id,
                'user_created_id'=>Auth::user()->id,
                'amount'=>$request->initial_balance,
            ]);
        }

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
        $cashBoxes = CashBox::where('id','!=',$cashBox->id)->get();
        return view('cashboxes.show',compact('cashBox','cashBoxes'));
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

    }

    public function checkCashBox(){
        $cashBoxes = CashBox::all();
        $check = false;
        if(count($cashBoxes)>0){
            $check = true;
        }
        return response()->json(['cashBox'=>$check]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CashBox $cashBox
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeTransfer(Request $request,$id){
        $this->validate($request, [
            'transfer_cash_box_id'=>'required',
            'amount'=>'required'
        ]);

        $cashBox = CashBox::findOrFail($id);
        if($cashBox->current_balance<$request->amount){
            $notification = array(
                'message' => 'Сумма неправильная',
                'alert-type' => 'error'
            );

            return redirect()->route('cashBoxes.show', $id)
                ->with($notification);
        }
        $time = strtotime(str_replace('/', '-',date('Y/m/d', time())));
        $newformat = date('Y-m-d',$time);

        $cashBox->current_balance = $cashBox->current_balance-$request->amount;
        $cashBox->expanse = $cashBox->expanse+$request->amount;
        $cashBox->save();

        $transferCashBox = CashBox::findOrFail($request->transfer_cash_box_id);
        $transferCashBox->current_balance = $transferCashBox->current_balance+$request->amount;
        $transferCashBox->income = $transferCashBox->income+$request->amount;
        $transferCashBox->save();

        CashFlow::create([
            'cash_flow_date'=>$newformat,
            'payment_item_id'=>\StaticPaymentItems::$paymentItems['toCashBox'],
            'cash_box_id'=>$transferCashBox->id,
            'user_created_id'=>Auth::user()->id,
            'amount'=>$request->amount,
            'comments'=>"Перевод в ".$transferCashBox->name,
        ]);

        CashFlow::create([
            'cash_flow_date'=>$newformat,
            'payment_item_id'=>\StaticPaymentItems::$paymentItems['fromCashBox'],
            'cash_box_id'=>$cashBox->id,
            'user_created_id'=>Auth::user()->id,
            'amount'=>$request->amount,
            'comments'=>"Перевод из ".$cashBox->name,
        ]);
        $notification = array(
            'message' => 'Перевод прошел!',
            'alert-type' => 'success'
        );

        return redirect()->route('cashBoxes.index')
            ->with($notification);

    }
}
