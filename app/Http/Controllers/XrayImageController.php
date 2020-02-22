<?php

namespace App\Http\Controllers;

use App\XrayImage;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class XrayImageController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(count($request->images)){
            foreach ($request->images as $image) {
                $extension = $image->getClientOriginalExtension();
                Storage::disk('xray_data')->put($image->getFilename().'.'.$extension,File::get($image));
                XrayImage::create([
                    'patient_id'=>$request->patient_id,
                    'photoname'=>$image->getFilename().'.'.$extension,
                    'mime'=>$image->getClientMimeType(),
                    'original_photoname'=>$image->getClientOriginalExtension()
                ]);
            }
        }


        return response()->json([
            "message" => "Done"
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\XrayImage  $xrayImage
     * @return \Illuminate\Http\Response
     */
    public function show(XrayImage $xrayImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\XrayImage  $xrayImage
     * @return \Illuminate\Http\Response
     */
    public function edit(XrayImage $xrayImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\XrayImage  $xrayImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $xrayImage = XrayImage::findOrFail($id);
        $patient_id = $xrayImage->patient_id;
        XrayImage::where('id','=',$xrayImage->id)->update(['appointment_date'=>$request->appointment_date,'comments'=>$request->xraycomments]);

        $notification = array(
            'message' => 'Снимок обновлен',
            'alert-type' => 'success',
            'tab'=>'xray'
        );

        return redirect()->route('patients.show',[$patient_id])
            ->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\XrayImage $xrayImage
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $xrayImage = XrayImage::findOrFail($id);
        $patient_id = $xrayImage->patient_id;
        Storage::disk('xray_data')->delete($xrayImage->photoname);
        $xrayImage->delete();
        $notification = array(
            'message' => 'Снимок удален',
            'alert-type' => 'info',
            'tab'=>'xray'
        );
        return redirect()->route('patients.show',[$patient_id])
            ->with($notification);
    }
}
