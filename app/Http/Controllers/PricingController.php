<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pricing;
class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pricingCreateUpdate(Request $request){
        $pricing=Pricing::first();
        if($request->isMethod('post')){
            $data=$request->except(['_token']);
            if($pricing){
                Pricing::where('id',$pricing->id)->update($data);
                return redirect()->back()->with('success','Price updated successfully');
            }else{
                Pricing::create($data);
                return redirect()->back()->with('success','Price created successfully');
            }
        }
        
        return view('pricing.edit',compact('pricing'));
    }
    
}
