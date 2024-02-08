<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Region;
class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions=Region::orderBy('id', 'DESC')->get();
        
        return view('Region.index',compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('Region.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['name']=$request->name;
        $data['arabic_name']=$request->arabic_name;
        Region::create($data);
        return redirect()->route('region.index')->with('success','Region created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Region=Region::find($id);
        return view('Region.view',compact('Region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region=Region::find($id);
        return view('Region.edit',compact('region'));
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
        $data['name']=$request->name;
        $data['arabic_name']=$request->arabic_name;
        Region::where('id',$id)->update($data);
        return redirect()->route('region.index')->with('success','Region updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Region::where('id',$id)->delete();
       return 1;
    }

    public function updateRegionStatus(Request $request)
    {
       Region::where('id',$request->id)->update(['status'=>$request->status]);
       return 1;
    }
}
