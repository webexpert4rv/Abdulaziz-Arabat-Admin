<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Region;
use App\Models\BlogCategory;
class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData=BlogCategory::orderBy('id', 'DESC')->get();
        
        return view('BlogCategory.index',compact('getData'));
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('BlogCategory.create');
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
         
        BlogCategory::create($data);
        return redirect()->route('blog-category.index')->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=BlogCategory::find($id);
        return view('BlogCategory.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=BlogCategory::find($id);
        return view('BlogCategory.edit',compact('data'));
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
        BlogCategory::where('id',$id)->update($data);
        return redirect()->route('blog-category.index')->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       BlogCategory::where('id',$id)->delete();
       return 1;
    }

    public function updateBlogCategoryStatus(Request $request)
    {
       BlogCategory::where('id',$request->id)->update(['status'=>$request->status]);
       return 1;
    }
}
