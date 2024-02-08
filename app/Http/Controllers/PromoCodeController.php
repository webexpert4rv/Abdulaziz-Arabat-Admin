<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromoCode;
use App\Models\User;
class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promo_codes=PromoCode::all();
        return view('promo_code.index',compact('promo_codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users=User::withCount('booking')->orderBy('booking_count', 'desc')->whereIn('account_type',['0','1'])->limit(100)->get();
         
      
         return view('promo_code.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except(['fixed','percentage','expiry_date']);
        $data['value']=$request->type==0?$request->percentage:$request->fixed;
        $date_replace        =   str_replace('/','-',$request->expiry_date);
        $data['expiry_date']=date('Y-m-d',strtotime($date_replace));
      
        PromoCode::create($data);
        return redirect()->route('promocodes.index')->with('success','Promo code created successfuly');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $promocode=PromoCode::where('id',$id)->first();
         return view('promo_code.view',compact('promocode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $users=User::withCount('booking')->orderBy('booking_count', 'desc')->whereIn('account_type',['0','1'])->limit(100)->get();
       
         $promocode=PromoCode::where('id',$id)->first();
         return view('promo_code.edit',compact('promocode','users'));
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
        $data=$request->except(['_method','_token','fixed','percentage','expiry_date']);
        $data['value']=$request->type==0?$request->percentage:$request->fixed;
        $date_replace        =   str_replace('/','-',$request->expiry_date);
        $data['expiry_date']=date('Y-m-d',strtotime( $date_replace));
       
        PromoCode::where('id',$id)->update($data);
        return redirect()->route('promocodes.index')->with('success','Promo code updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PromoCode::where('id',$id)->delete();
        return response()->json([
            'success'=>1,
        ]);
    }
}
