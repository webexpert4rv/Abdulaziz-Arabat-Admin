<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Storage;
class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $testimonials=Testimonial::where('status',1)->get();
        return view('testimonial.index',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except(['_token','_method']);
        if($request->hasFile('image')) {
            $image              = Storage::disk('public')->putFile('TestimonialImage',$request->image);
            $data['image']      ='storage/'.$image;
        }   
        Testimonial::create($data);
        return redirect()->route('testimonials.index')->with('success','Testimonial created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $testimonial=Testimonial::find($id);
       return view('testimonial.view',compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial=Testimonial::find($id);
        return view('testimonial.edit',compact('testimonial'));
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
        $data=$request->except(['_token','_method']);
        if($request->hasFile('image')) {
            $image              = Storage::disk('public')->putFile('TestimonialImage',$request->image);
            $data['image']      ='storage/'.$image;
        }   
        Testimonial::where('id',$id)->update($data);
        return redirect()->route('testimonials.index')->with('success','Testimonial updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Testimonial::where('id',$id)->delete();
        return response()->json([
            'success'=>1,
        ]);
       
    }
}
