<?php 
use Twilio\Rest\Client;
#use Msegat;
use Carbon\Carbon;
use App\Models\Setting;
/*function sendMail($view, $emailData){
    \Mail::send($view, $emailData, function($message) use ($emailData) {
        $message->to($emailData['email'])
        ->subject($emailData['subject']); 

     });

     
    
}*/


function receiverVerificationCode($country_code,$number,$verificationCode,$message){

    $phone_number=$country_code.''.$number;

    $msg = \Msegat::sendMessage($phone_number, $message.':'.$verificationCode);

    return $msg;
        //  $body = 'Your delivery verification code is : '.$verificationCode;

}

function sendWhatsappMessage($country_code,$number,$message){

    // $sid            = getenv('TWILIO_SID');
    // $token          = getenv("TWILIO_AUTH_TOKEN");

    $sid=config('services.twilio.TWILIO_SID');
    $token=config('services.twilio.TWILIO_AUTH_TOKEN');
      
    // $sid            = "AC663f1295d524f6c9254420d1f0b4f96f";
    // $token          = "250794cc5fbe94654319a744fe27a3f2";
     
    $twilio         = new Client($sid, $token);

    $countrycode ='+966';
    
    try{
    $message = $twilio->messages->create("whatsapp:".$countrycode.(string)$number, ["from" => "whatsapp:+14155238886","body" => $message]);
    }catch(\Exception $e){
       return false;
   }
 
    return $message;

}


function sendMail($view, $emailData){


        return  \Mail::send($view, $emailData, function($message) use ($emailData) {
            $message->to($emailData['email'])
            ->subject($emailData['subject']); 
        });
    }


function isRFQTime()
{
    $detting= Setting::first()->schedule_day_time;
    $parts= explode('_', $detting);

    if ($parts[0]=='hour') {

        return Carbon::now()->addHour((int)$parts[1]);


    }elseif ($parts[0]=='d'){

        return Carbon::now()->addDays((int)$parts[1]);
    }
}


    function sameDayTime()
{
    $detting= Setting::first()->same_day_time;
    $parts= explode('_', $detting);

    if ($parts[0]=='hour') {

        return Carbon::now()->addHour((int)$parts[1]);


    }elseif ($parts[0]=='mit'){

        return Carbon::now()->addMinute((int)$parts[1]);
    }
}

function LanguageStatus($getStatus){

    $status=ucfirst(str_replace('_', ' ',$getStatus));
    
     

      if ($getStatus=='pending') {

        $status='في تَقَدم';             
    }       

    if ($getStatus=='completed') {

        $status='منجز';             
    }
    if ($getStatus=='in-progress') {

        $status='في تَقَدم';             
    }

    if ($getStatus=='not_started_yet') {

        $status='لم تبدأ بعد';             
    }
    if ($getStatus=='started') {

        $status='بدأت';             
    }
    if ($getStatus=='transporter_at_pick_up_location') {

        $status='الناقل في موقع الالتقاط';             
    }
    if ($getStatus=='goods_picked_up') {

        $status='التقطت البضائع';             
    }
    if ($getStatus=='on_the_way') {

        $status='علي الطريق';             
    }
    if ($getStatus=='arrived_at_destination') {

        $status='وصلت الوجهة';             
    }
    if ($getStatus=='delivered') {

        $status='تم التوصيل';             
    }
    if ($getStatus=='service_completed') {

        $status='اكتملت الخدمة';             
    }
    if ($getStatus=='cancelled') {

        $status='ألغيت';             
    }
    if ($getStatus=='success') {

        $status='النجاح';             
    }
    if ($getStatus=='failed') {

        $status='باءت بالفشل';             
    }
    if ($getStatus=='ongoing') {

        $status='جاري التنفيذ';             
    } 
    if ($getStatus=='Ongoing') {

        $status='جاري التنفيذ';             
    } 
    if ($getStatus=='Booked') {

        $status='حجز';             
    }
    if ($getStatus=='payment-pending') {

        $status='انتظار الدفع';             
    }
    if ($getStatus=='payment_pending') {

        $status='انتظار الدفع';             
    }
 

return $status;
}

function LanguageStatusType($getStatus,$type){
    $status=ucfirst(str_replace('_', ' ',$getStatus));
    
    if ($type==2) {

      if ($getStatus=='pending') {

        $status='في تَقَدم';             
    }       

    if ($getStatus=='completed') {

        $status='منجز';             
    }
    if ($getStatus=='in-progress') {

        $status='في تَقَدم';             
    }

    if ($getStatus=='not_started_yet') {

        $status='لم تبدأ بعد';             
    }
    if ($getStatus=='started') {

        $status='بدأت';             
    }
    if ($getStatus=='transporter_at_pick_up_location') {

        $status='الناقل في موقع الالتقاط';             
    }
    if ($getStatus=='goods_picked_up') {

        $status='التقطت البضائع';             
    }
    if ($getStatus=='on_the_way') {

        $status='علي الطريق';             
    }
    if ($getStatus=='arrived_at_destination') {

        $status='وصلت الوجهة';             
    }
    if ($getStatus=='delivered') {

        $status='تم التوصيل';             
    }
    if ($getStatus=='service_completed') {

        $status='اكتملت الخدمة';             
    }
    if ($getStatus=='cancelled') {

        $status='ألغيت';             
    }
    if ($getStatus=='success') {

        $status='النجاح';             
    }
    if ($getStatus=='failed') {

        $status='باءت بالفشل';             
    }
    if ($getStatus=='ongoing') {

        $status='جاري التنفيذ';             
    } 
    if ($getStatus=='Ongoing') {

        $status='جاري التنفيذ';             
    } 
    if ($getStatus=='Booked') {

        $status='حجز';             
    }
    if ($getStatus=='payment-pending') {

        $status='انتظار الدفع';             
    }
    if ($getStatus=='payment_pending') {

        $status='انتظار الدفع';             
    }
}

return $status;
}



?>
