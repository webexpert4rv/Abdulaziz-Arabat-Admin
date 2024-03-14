<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
class SettingController extends Controller
{
    //
    public function setting(Request $request){
        $setting        =   Setting::first();
        $data['radius'] = $request->radius;
        $data['schedule_day_time'] = $request->schedule_day_time;
        $data['same_day_time'] = $request->same_day_time;
        $data['show_referel'] = $request->show_referel;
        $data['show_promotion'] = $request->show_promotion;
        $data['show_promo_app'] = $request->show_promo_app;
        $data['show_referel_app'] = $request->show_referel_app;
        $data['rfq_limit_for_driver'] = $request->rfq_limit_for_driver;
        // $data['rfq_limit_for_user'] = $request->rfq_limit_for_user;
        if($request->isMethod('post')){
            if($setting){
                $setting->update($data);
            }else{
                
                Setting::create($data);
            }
            
            return redirect()->back()->with('success','Setting updated successfully');
        }
        return view('setting',compact('setting'));
    }
}
