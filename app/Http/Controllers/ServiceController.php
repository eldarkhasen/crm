<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    /**
     * ServiceController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth','hasPerToServices'], ['except' => ['get']]);
    }

    public function index()
    {
        $services = Service::all();
        return view('services.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:120',
            'duration'=>'required|numeric',
            'category'=>'required',
            'description'=>'required',
            'price'=>'required|numeric',
            'max_price'=>'required|numeric',

        ]);

        Service::create([
            'name'=> $request->name,
            'description'=>$request->description,
            'duration'=>$request->duration,
            'category'=>$request->category,
            'price'=>$request->price,
            'max_price'=>$request->max_price
        ]);

        $notification = array(
            'message' => 'Услуга добавлена',
            'alert-type' => 'success'
        );

        return redirect()->route('services.index')
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
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
        $this->validate($request, [
            'name'=>'required|max:120',
            'duration'=>'required|numeric',
            'category'=>'required',
            'description'=>'required',
            'price'=>'required|numeric',
            'max_price'=>'required|numeric',
        ]);

        $service = Service::findOrFail($id);
        $input = $request->all();
        $service->fill($input)->save();

        $notification = array(
            'message' => 'Услуга обновлена',
            'alert-type' => 'info'
        );

        return redirect()->route('services.index')
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
        $service = Service::findOrFail($id);
        $service->delete();
        $notification = array(
            'message' => 'Услуга удалена',
            'alert-type' => 'info'
        );
        return redirect()->route('services.index')
            ->with($notification);
    }

    public function getServices(){
        return Service::all();
    }

    public function get(){
        return response()->json(['services' => Service::all()]);
    }
}
