<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Region;
use App\Models\BlogCategory;
use App\Models\FAQ;
use App\Models\Video;
use Storage;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData=Video::orderBy('id', 'DESC')->get();
        
        return view('Video.index',compact('getData'));
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data['video_title']=$request->video_title;
        $data['arabic_video_title']=$request->arabic_video_title;

        if($request->hasFile('video')) {
            $video              = Storage::disk('public')->putFile('video',$request->video);
            $data['video']      ='storage/'.$video;
        }  

        Video::create($data); 
        return redirect()->route('video.index')->with('success','Video uploaded successfully ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Video::find($id);
        return view('video.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Video::find($id);
        return view('Video.edit',compact('data'));
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
        $data['video_title']=$request->video_title;
        $data['arabic_video_title']=$request->arabic_video_title;
 
        if($request->hasFile('video')) {
            $video              = Storage::disk('public')->putFile('video',$request->video);
            $data['video']      ='storage/'.$video;
        }   
     
        Video::where('id',$id)->update($data);
        return redirect()->route('video.index')->with('success','Vido updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     Video::where('id',$id)->delete();
     return 1;
 }

 public function updateVideoStatus(Request $request)
 {
     Video::where('id',$request->id)->update(['status'=>$request->status]);
     return 1;
 }
}
