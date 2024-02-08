<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutorialList=Tutorial::get();
        return view('tutorial.index',compact('tutorialList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tutorial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $data['title']              =   $request->title;
        $data['description']        =   $request->description;
        $data['title_arabic']       =   $request->arabic_title;
        $data['description_arabic'] =   $request->arabic_description;
        Tutorial::create($data);
        return redirect()->route('tutorials.index')->with('success','Tutorial created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tutorial   =   Tutorial::where('id',$id)->first();
        return view('tutorial.view',compact('tutorial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tutorial   =   Tutorial::where('id',$id)->first();
        return view('tutorial.edit',compact('tutorial'));
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
        //
        
        $data['title']              =   $request->title;
        $data['description']        =   $request->description;
        $data['title_arabic']       =   $request->arabic_title;
        $data['description_arabic'] =   $request->arabic_description;
       
        Tutorial::where('id',$id)->update($data);
        return redirect()->route('tutorials.index')->with('success','Tutorial updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tutorial::where('id',$id)->delete();
        return 1;
    }
}
