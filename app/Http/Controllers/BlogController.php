<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\BlogCategory;
use App\Models\Blog;
use Storage;
class BlogController extends Controller
{
   public function index()
   {

    $getData=Blog::orderBy('id', 'DESC')->with('admin')->get();



    return view('Blogs.index',compact('getData'));
}

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogCategory=BlogCategory::orderBy('id', 'DESC')->get();        
        return view('Blogs.create',compact('blogCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data=$request->all();
      $data['created_by']      =Auth()->user()->id;

      if($request->hasFile('blog_image')) {
        $blog_image              = Storage::disk('public')->putFile('blog_image',$request->blog_image);
        $data['blog_image']      ='storage/'.$blog_image;
    }  

    Blog::create($data);
    return redirect()->route('blogs.index')->with('success','Blog created successfully');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Blog::find($id);
        return view('Blogs.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Blog::find($id);
        return view('Blogs.edit',compact('data'));
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
        
        $data['created_by']      =Auth()->user()->id;
        $data['blog_title']      =$request->blog_title;
        $data['description']      =$request->description;
        $data['arabic_blog_title']      =$request->arabic_blog_title;
        $data['arabic_description']      =$request->arabic_description;
        if($request->hasFile('blog_image')) {
            $blog_image              = Storage::disk('public')->putFile('blog_image',$request->blog_image);
            $data['blog_image']      ='storage/'.$blog_image;
        }  
        Blog::where('id',$id)->update($data);
        return redirect()->route('blogs.index')->with('success','Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Blog::where('id',$id)->delete();
       return 1;
   }

   public function updateBlogsStatus(Request $request)
   {
       Blog::where('id',$request->id)->update(['status'=>$request->status]);
       return 1;
   }
}
