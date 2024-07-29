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

 
function iosPushNotification($deviceToken,$title,$message,$data)
{
        try{
            // Paths to the PEM files
            $certFilePath = public_path('cert.pem');
            $keyFilePath = public_path('key.pem');
        
            $p12Password = 'rvtech';
            $bundleId = 'com.rvtech.arabat';

            //$apnsServer     = 'https://api.sandbox.push.apple.com'; 
            $apnsServer   = 'https://api.push.apple.com'; 

            $apnsPort = 443;
            // Payload to send to the device
            $payload = json_encode([
                'aps' => [
                    'title'     => $title,
                    'alert'     => $title,
                    'message'   => $message,   
                    'data'      => $data,             
                    'sound'        => 'default',
                    'mutable-content' => '1', 
                    'content-available' => '1',
                            
                ]
            ]);

            // Setup the HTTP/2 headers
            $headers = [
                "apns-topic: " . $bundleId, // Change to your app's bundle ID
                "User-Agent: My Sender",
                "Content-Type: application/json"
            ];

            // Initialize cURL
            $ch = curl_init();
            // Setup cURL options
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);
            curl_setopt($ch, CURLOPT_URL, "$apnsServer/3/device/$deviceToken");
            curl_setopt($ch, CURLOPT_PORT, $apnsPort);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSLCERT, $certFilePath);
            curl_setopt($ch, CURLOPT_SSLKEY, $keyFilePath);
            curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $p12Password);

            // Execute the request and fetch the response
            $response = curl_exec($ch);
            // Check for errors
            if ($response === false) {
               // $error = curl_error($ch);
                //echo "Curl error: $error\n";
            } else {
                // Print the response from APNs
                //$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
               // echo "HTTP Status: $httpcode\n";
               // echo "Response: $response\n";
            }
            // Close cURL resource
            curl_close($ch);  
            
        }catch(\Exception $e){
    
        return response()->json([
            'status' => 400,
            'message' => $e->getMessage(),
        ]);
    }

}  


function sendSMSAcceptJobToTransporter($number,$user_name,$order_number)
{
    
    $phone_number =(int)str_replace(' ', '', $number);   
      

    // $message_body = "عزيزي {$user_name}
    // تم قبول عرض الأسعار الخاص بك من قبل العميل. ويمكن العثور على مزيد من التفاصيل في حسابك.

    // آپ کی کوٹیشن پیشکش کلائنٹ کی طرف سے قبول کر لی گئی ہے۔ مزید آرڈر کی تفصیلات آپ کے اکاؤنٹ میں مل سکتی ہیں۔

    // Your quotation offer is accepted by client. Further details can be found in your account.

    // رقم طلبك :  ({$order_number}) \n
    // Order number :  ({$order_number})";


$message_body ="
عزيزي {$user_name}
تم قبول عرض الأسعار الخاص بك من قبل العميل. ويمكن العثور على مزيد من التفاصيل في حسابك.
آپ کی کوٹیشن پیشکش کلائنٹ کی طرف سے قبول کر لی گئی ہے۔ مزید آرڈر کی تفصیلات آپ کے اکاؤنٹ میں مل سکتی ہیں۔
Your quotation offer is accepted by client. Further details can be found in your account.
رقم طلبك:    Order number :  {$order_number}";


    sendSMSs($phone_number,$message_body); 

}

function sendSMSAcceptJobToDriver($number,$user_name,$order_number)
{
    
    $phone_number =(int)str_replace(' ', '', $number);  
    // $message_body = "عزيزي {$user_name}, \n
    // تم قبول عرض الأسعار الخاص بك من قبل العميل. ويمكن العثور على مزيد من التفاصيل في حسابك.\n
    // آپ کی کوٹیشن پیشکش کلائنٹ کی طرف سے قبول کر لی گئی ہے۔ مزید آرڈر کی تفصیلات آپ کے اکاؤنٹ میں مل سکتی ہیں۔\n
    // Your quotation offer is accepted by client. Further details can be found in your account.\n
    // رقم طلبك:    Order number :  {$order_number}";
            
    $message_body ="
    عزيزي {$user_name}
    تم قبول عرض الأسعار الخاص بك من قبل العميل. ويمكن العثور على مزيد من التفاصيل في حسابك.

    آپ کی کوٹیشن پیشکش کلائنٹ کی طرف سے قبول کر لی گئی ہے۔ مزید آرڈر کی تفصیلات آپ کے اکاؤنٹ میں مل سکتی ہیں۔

    Your quotation offer is accepted by client. Further details can be found in your account.

    رقم طلبك:    Order number :  ({$order_number})";

    sendSMSs($phone_number,$message_body); 

}


function sendSMSs($phone_number,$message_body){
    try{   
      
        $apiUrl = 'https://api.taqnyat.sa/v1/messages';
        $accessToken = '475b33120697346bd743efb7e311993f';
    
        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ];
    
        $data = [
            'recipients' => [$phone_number],
            'body' => $message_body,
            'sender' => 'Arabat.sa',
        ];
    
        // \Log::info([
        //     'job_create_otp' => $data
        // ]);
     

        $ch = curl_init($apiUrl);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
        $response = curl_exec($ch);
    
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
    
        curl_close($ch);
    
        // \Log::info([
        //     'user_resend_otp_res_ok--' => $response
        // ]);
    
    
    }catch(\Exception $e){
        // \Log::info([
        //     'error occured in sending sms for forget pass' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile()
        // ]);
    }
}
  



?>
