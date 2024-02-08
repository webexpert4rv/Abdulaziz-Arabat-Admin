<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Region;
use App\Models\BlogCategory;
use App\Models\FAQ;
class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData=FAQ::orderBy('id', 'DESC')->get();
        
        return view('FAQ.index',compact('getData'));
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('FAQ.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['question']=$request->question;
        $data['arabic_question']=$request->arabic_question;
        $data['answer']=$request->answer;
        $data['arabic_answer']=$request->arabic_answer;
         
        FAQ::create($data);
        return redirect()->route('faq.index')->with('success','FAQ created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=FAQ::find($id);
        return view('FAQ.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=FAQ::find($id);
        return view('FAQ.edit',compact('data'));
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
        $data['question']=$request->question;
        $data['arabic_question']=$request->arabic_question;
        $data['answer']=$request->answer;
        $data['arabic_answer']=$request->arabic_answer;
        FAQ::where('id',$id)->update($data);
        return redirect()->route('faq.index')->with('success','FAQ updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       FAQ::where('id',$id)->delete();
       return 1;
    }

    public function updateBlogCategoryStatus(Request $request)
    {
       FAQ::where('id',$request->id)->update(['status'=>$request->status]);
       return 1;
    }
}
