<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Region;
use App\Models\SubRegion;

class SubRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $subRegions=SubRegion::orderBy('region_id', 'DESC')->with('Region')->get();         
        
        return view('SubRegion.index',compact('subRegions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $regions=Region::All(); 
         return view('SubRegion.create',compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['region_id']=$request->region_id;
        $data['name']=$request->name;
        $data['arabic_name']=$request->arabic_name;
        $data['lat']=$request->lat;
        $data['long']=$request->long;
        $data['status']=1;
        SubRegion::create($data);
        return redirect()->route('sub-region.index')->with('success','Region created successfully');
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

        return view('Region.view',compact('regions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subRegion=SubRegion::find($id);
         $regions=Region::orderBy('id', 'DESC')->get(); 
        return view('SubRegion.edit',compact('subRegion','regions'));
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
        $data['region_id']=$request->region_id;
        $data['name']=$request->name;
        $data['lat']=$request->lat;
        $data['long']=$request->long;
        $data['arabic_name']=$request->arabic_name;
        SubRegion::where('id',$id)->update($data);
        return redirect()->route('sub-region.index')->with('success','Sub Region updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       SubRegion::where('id',$id)->delete();
       return 1;
    }

    public function updateSubRegionStatus(Request $request)
    {
         
       SubRegion::where('id',$request->id)->update(['status'=>$request->status]);
       return 1;
    }
}
