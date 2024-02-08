<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleType;
use DB;
use Storage;
class VehicleTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicleType    =    VehicleType::all();
        return view('vehicletypes.index',compact('vehicleType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicle_category=DB::table('vehicle_type_categories')->get();
        return view('vehicletypes.create',compact('vehicle_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data   =   $request->except(['_token']);
        if ($request->hasFile('image')) {
            $image            = Storage::disk('public')->putFile('vehicle_type_category',$request->image);
            $data['image']  ='storage/'.$image;
         }  
        VehicleType::create($data);
        return redirect()->route('vehicletypes.index')->with('success','Vehicle Type created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicletype=VehicleType::find($id);
        return view('vehicletypes.view',compact('vehicletype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle_category=DB::table('vehicle_type_categories')->get();
        $vehicletype=VehicleType::find($id);
        return view('vehicletypes.edit',compact('vehicle_category','vehicletype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data   =   $request->except(['_token','_method','current_image']);

        if ($request->hasFile('image')) {
            $image            = Storage::disk('public')->putFile('vehicle_type_category',$request->image);
            $data['image']  ='storage/'.$image;
        }

        VehicleType::where('id',$id)->update($data);
        return redirect()->route('vehicletypes.index')->with('success','Vehicle Type created successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       VehicleType::where('id',$id)->delete();
       return 1;
    }
}
