<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\VehicleType;
use App\Models\Vehicle;
use App\Models\Product;
use App\Models\Region;
use App\Models\JobReceiver;
use App\Models\ReceiveQuotes;
use App\Exports\JobExport;
use App\Models\Transaction;
use App\Models\BookingStatusUpdate;
use App\Models\Pricing;
use App\Models\ReferrerWallet;
use App\Models\UserCancelJobPenality;
use App\Models\BankAccount;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DataTables;
use App\Models\SubRegion;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;  
use App\Models\Setting;
use App\Models\User;
use Config;
use App\Models\Booking;
use App\Models\Notification as Notifica; 
use App\Models\RequestQuotes;
use Illuminate\Support\Facades\Notification;
use App\Models\JobsPaymentDetails;
use Log;
use DB;
class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /*public function index(Request $request)
    {
         
       if($request->id){

          $job_ids=ReceiveQuotes::where('driver_id',$request->id)->pluck('job_id');
         
          $jobs   =  Job::with('product','PickupRegion','PickupSubRegion','JobReceiver')->whereIn('id',$job_ids)->orderBy('id','DESC')
         // ->orderBy('status','ASC')
          ->get();
       }else{
         
          $jobs   =  Job::with('product','PickupRegion','PickupSubRegion','JobReceiver')->orderBy('id','DESC')
         // ->orderBy('status','ASC')
          ->get();
         
       }
        
        
        
        
        return view('jobs.index-backup',compact('jobs'));
    }*/


    public function index(Request $request)    
    {
    
        if ($request->ajax()) { 

            $data =Job::whereNull('created_by')->with('product','PickupRegion','PickupSubRegion','JobReceiver','receiveQuote')
            ->with('JobReceiver',function($q){
                $q->with('DestinationRegion');

            })

            ->orderBy('id','DESC');
            
            if (!empty($request->date_range[0])) {
                $date_range = $request->date_range; 
                $data->whereDate('created_at','>=',date('Y-m-d',strtotime($date_range[0])))
                ->whereDate('created_at','<=',date('Y-m-d',strtotime($date_range[1])));
            }
            
            if (!empty($request->job_status)) {
                
                $data->where('status',$request->job_status);
                
            }            

            $getData=$data->get();
            
            return Datatables::of($getData)
            ->addIndexColumn()

            ->addColumn('schedule_date', function($row){
                $btn =  date('d/m/Y',strtotime($row->schedule_date)) ;
                return $btn;
            })
            ->addColumn('schedule_time', function($row){
                $btn =  date('h:i A',strtotime($row->schedule_time)) ;
                return $btn;
            })
            ->addColumn('pick_up_address', function($row){
                $btn =   @$row->PickupSubRegion->name .','.@$row->PickupRegion->name;
                return $btn;
            }) 

            ->addColumn('destination_address', function($row){
                $btn =   @$row->JobReceiver->DestinationSubRegion->name .','.@$row->JobReceiver->DestinationRegion->name ;  


                return $btn;
            }) 


            ->addColumn('number_of_vehicle', function($row){
                $btn =   @$row->number_of_vehicle ;
                return $btn;
            })
            ->addColumn('status', function($row){
                $btn =  ucfirst($row->status) ;
                return $btn;
            })
            ->addColumn('action', function($row){

                $btn1=$btn2=$btn3=$btn4='';
                if(auth()->user()->can('view_jobs'))
                {
                    $btn1= '<a class="action-button" title="View" href='.route('jobs.show',$row->id).'><i class="text-info fa fa-eye"></i></a>';
                }

                if(auth()->user()->can('delete_jobs'))
                {
                    $btn3=  '<a class="action-button delete-button "   id="'.$row->id.'"  onclick="deleteJob('.$row->id.')" title="Delete" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt" style="padding:4px;"></i></a>';
                }
                 
                $checkJobReceivedByUser = DB::table('receive_quotes')->where('job_id',$row->id)->whereIn('status',['payment-pending','delivered'])->count();
                 
                $btn4='';
                if(@$row->status=='pending' && $checkJobReceivedByUser=='0'){
                $btn4='<button type="button" id="'.$checkJobReceivedByUser.'" value="'.$row->id.'" class="sendJobTransporterPopup" style="background-color:#ffcd35;border-color:#ffcd35;">Send to Transporter</button>';
                }
                
                return $btn1.$btn2.$btn3.$btn4;
            }) 


            ->rawColumns(['schedule_date','schedule_time','pick_up_address','destination_address','number_of_vehicle','status','action'])
            ->make(true);
        }

        return view('jobs.index');
    } 
    public function expiredJob(Request $request) {
            // echo Carbon::now();
        $jobs=Job::where('is_active_date','<=',Carbon::now())->orderBy('id', 'DESC')->pluck('id');
        // echo '<pre>'; print_r($jobs); die;
        $receiveQuotes=ReceiveQuotes::whereNotIn('job_id',$jobs)->pluck('job_id');
        // echo '<pre>'; print_r($receiveQuotes); die;
        $getNewJobs = RequestQuotes::whereIn('job_id',$jobs)->where('admin_assignjob_to_transporter','1')->pluck('job_id');
        // echo '<pre>'; print_r($getNewJobs); die;
        $expiredJobs= Job::whereNotIn('id',$getNewJobs)->orderBy('id', 'DESC')->get(); 
        // echo '<pre>'; print_r($expiredJobs); die;
        $getTransporters=User::select('*')->where('role_id',Config::get('variables.Transporter'))->where('status','1')->get(); 
        return view('jobs.expiredJob',compact('expiredJobs','getTransporters'));
    }

    public function pendingPayment(Request $request) {
            
        // $receiveQuotes=ReceiveQuotes::where('status','payment-pending')->with('users')->get();
        $todayDateTime = date("Y-m-d H:i:s");
        // echo $todayDateTime;
        $pendingPayments = DB::table('receive_quotes')->select('jobs.job_ID','receive_quotes.id','receive_quotes.quote_amount','receive_quotes.status','u.name as userName','d.name as driverName')
                        ->join('jobs','receive_quotes.job_id','=','jobs.id')
                        ->join('users as u','receive_quotes.user_id','=','u.id')
                        ->join('users as d','receive_quotes.driver_id','=','d.id')
                        ->where('receive_quotes.status','payment-pending')
                        ->where('receive_quotes.approved_by_admin','no')
                        ->where('receive_quotes.is_active_date','>=',$todayDateTime)
                        ->orderBy('id','desc')->get();



        // echo '<pre>'; print_r($pendingPayments); die; 
        return view('jobs.pendingPayments',compact('pendingPayments'));
    }

    public function bookingNew($quoteId)
    {
        $quote = ReceiveQuotes::where('id',$quoteId) ->isExpired()->where('status','payment-pending')->with('driver','job')->first();
        if ($quote) {

            $vehicle     =  Vehicle::where('driver_id',$quote->driver->id)->with('vehicleType')->first();
            $jobReceiver =  JobReceiver::where('job_id',$quote->job_id)->orderBy('id', 'ASC')->get();

            $user = User::find($quote->user_id);

            $data = json_decode($quote->data, true);
            $pay_amount = $quote->quote_amount;
           
            if (true) {  
                
                $bookings = IdGenerator::generate(
                    [
                        'table' => 'bookings',
                        'field' =>'book_id', 
                        'length'=>12, 
                        'prefix'=>'ORD-'
                    ]);
                $tax = Pricing::first()->tax;           
                $total_amount_tax = $pay_amount;          
                $total_amount_without_tax =$total_amount_tax/(1+($tax/100));
                $tax_price = $total_amount_tax-$total_amount_without_tax;
                $booking=[
                    'book_id'           =>$bookings,
                    'booked_on'         =>Carbon::now(),
                    'driver_id'         => $quote->driver_id,
                    'job_id'            =>$quote->job_id,
                    'quote_id'          => $quote->id,
                    'user_id'           => $user->id,
                    'status'            =>"not_started_yet",
                    'transporter_name'  =>@ $quote->driver->name,
                    'booking_fee'       =>@$pay_amount,
                    'date_of_service'   =>@$quote->job->schedule_date,
                    'time_of_service'   =>@$quote->job->schedule_time,
                    'vehicle_make'      =>@$vehicle->vehicle_registration_year,
                    'vehicle_colour'    =>@$vehicle->Vehicle_colour,
                    'license_plate'     =>@$vehicle->license_plate,
                    'vehicle_name'      =>@$vehicle->vehicleType->name,
                    'mobile_number'     =>@$quote->driver->phone_number,
                    'pick_up_region_id' =>@$quote->job->pick_up_region_id,
                    'pick_up_sub_region_id'=>@$quote->job->pick_up_sub_region_id,                    
                    'pick_up_latitude'  =>@$quote->job->pick_up_lat,
                    'pick_up_longitude' =>@$quote->job->pick_up_long,
                    'payment_status'    =>"success",
                    'quote_amount'      =>@$pay_amount,
                    'discount'          =>@$data['discount'],
                    'tax_price'         =>@$tax_price,
                    'penaltiy_amount'   =>@$data['penaltiy'],


                ];               

 
                $getBooking = Booking::create($booking);


                if (Booking::where('user_id',$user->id)->count()==1) {
                    $greferrer = User::where('id',$user->id)->where('referrer_id','!=','')->first();

                    if ($greferrer) {

                        if (ReferrerWallet::where('user_id',$user->id)->doesntExist()) {

                            $data=[
                                'user_id'       =>$user->id,
                                'earn'   =>5,
                                'spend'   =>'',
                            ];
                            ReferrerWallet::create($data);
                        }else{
                            ReferrerWallet:: where('user_id',$user->id)->increment('earn', 5);
                        }
                        if (ReferrerWallet::where('user_id',$greferrer->referrer_id)->doesntExist()) {
                            $data=[
                                'user_id'       =>$greferrer->referrer_id,
                                'earn'   =>5,
                                'spend'   =>'',
                            ];
                            ReferrerWallet::create($data);
                        }else{
                            ReferrerWallet:: where('user_id',$greferrer->referrer_id)->increment('earn', 5);
                        }
                    }
                }

 
                $tracking_id =(dechex($getBooking->id).uniqid());

                $getBooking->update([
                    'tracking_id' =>$tracking_id,
                    'invoice_no' =>'invoice-'.date('Yms').$getBooking->id,

                ]);


                $message = 'Booking No:'.$getBooking->book_id.' (Arabat) has been booked on '.$getBooking->booked_on.'. Track your Booking @  '.env('STORAGE_PATH').'track-order/'.$tracking_id;

                foreach ($jobReceiver as $key => $jobReceivervalue) {

                    sendWhatsappMessage('+966' ,$jobReceivervalue->receiver_number,$message);

                }

                UserCancelJobPenality::where('user_id',$user->id)
                ->where('job_id',$quote->job_id)->update(['status'=>0]);

                ReceiveQuotes::where('id',$quoteId)->where('user_id',$user->id)->update(['status'=>'accepted']);

                RequestQuotes::whereNotIn('driver_id',[$quote->driver_id])
                ->whereNotIn('status',['quote_post'])
                ->where('job_id',$quote->job_id)->update(['status'=>'closed']);

                RequestQuotes::where('driver_id',$quote->driver_id)->where('job_id',$quote->job_id)->update(['status'=>'accepted']);

                $transactions =[
                    'booking_id'    =>$getBooking->id,
                    'job_id'        =>$quote->job_id,
                    'driver_id'     =>$quote->driver_id,
                    'user_id'       =>$quote->user_id,
                    'transaction_id'=>@$getResponse['id'],
                    'booked_on'     =>@$getResponse['processed_on'],
                    'amount'        =>@$getResponse['amount']/100,
                    'status'        =>@$getResponse['status'],
                    'approved'      =>@$getResponse['approved'],
                    'customer'      =>@$getResponse['customer']['id'],
                    'customer_email'=>@$getResponse['customer']['email'],
                //  'response'      =>json_encode($getResponse),
                    'bank_account_id'  =>@$getResponse['bank_account_id'],
                    'bank_name'        =>@$getResponse['bank_name'],
                    'account_info'     =>@$getResponse['account_info'],
                    'bank_rceipt'      =>@$getResponse['bank_rceipt'],
                    'remitter_name'    =>@$getResponse['remitter_name'],
                ];   

                Transaction::create($transactions);

                BookingStatusUpdate::insert([
                    'booking_id' =>$getBooking->id,
                    'driver_id'  =>$quote->driver_id,
                    'status'     =>'not_started_yet',

                ]);

                $booking  =  Booking::where('id',$getBooking->id)
                ->with('driver',function($q){
                    $q->with('transporter');
                })
                ->with('job')        
                ->first();                 
                $country_code         =$booking->driver->country_code;
                $number         =$booking->driver->phone_number;
                $message        ='Client mobile number : '.$user->phone_number .' and pickup address : '  . $booking->job->pick_up_address;
                sendWhatsappMessage($country_code,$number,$message);

                $getBookingDetail =Booking::where('id',$getBooking->id)->with('user','driver','job')->first();
                $jobReceivers =JobReceiver::with('DestinationAddres')->where('job_id',$getBookingDetail->job_id)->get();


                $pricing    =   Pricing::first();
                $commission=(($getBookingDetail->quote_amount*$pricing->online_payment_discount)/100)*(1+$pricing->tax/100); 


                $checkUserCommission = User::select('commission')->where('id',$user->id)->first();

                if(!empty($checkUserCommission)){
                    $userCommission =$checkUserCommission->commission;

                    if($userCommission!='' && $userCommission!=null){ 
                        
                        $commission=(($getBookingDetail->quote_amount*$userCommission)/100)*(1+$pricing->tax/100);

                    }
                }
 
                if($getBookingDetail->job->product->name=='Other') {
                    $title=$getBookingDetail->job->other;

                }else{
                    $title=$user->language_code=="ar"?$getBookingDetail->job->product->arabic_name:$getBookingDetail->job->product->name;

                }

                $data=[
                    'book_id'      =>$getBookingDetail->book_id,
                    'booked_on'    =>$getBookingDetail->booked_on,
                    'invoice_no'   =>$getBookingDetail->invoice_no,
                    'booking_status' =>$getBookingDetail->status, 
                    'user'=>[
                        'name'                =>@$getBookingDetail->user->name,
                        'email'               =>@$getBookingDetail->user->email, 
                        'phone_number'        =>@$getBookingDetail->user->country_code.@$getBookingDetail->user->phone_number,
                        'city'                =>@$getBookingDetail->user->city, 
                    ],
                    'transporter'=>[
                        "name"=>@$getBookingDetail->driver->transporter->name,
                        "pta_license_number"=>@$getBookingDetail->driver->transporter->transporterDetails->pta_license_number,

                    ],
                    'driver'=>[
                        'name'                =>@$getBookingDetail->driver->name,
                        'email'               =>@$getBookingDetail->driver->email, 
                        'phone_number'        =>@$getBookingDetail->driver->country_code.@$getBookingDetail->driver->phone_number,
                        'city'                =>@$getBookingDetail->driver->city,
                    ], 
                    'job'=>[
                        'title'               =>@$title,
                        'job_id'              =>@$getBookingDetail->job->job_ID,
                        'schedule_date'       =>@$getBookingDetail->job->schedule_date,
                        'schedule_time'       =>@$getBookingDetail->job->schedule_time,
                        'vehicle_type'        =>@$getBookingDetail->vehicle_name, 

                        'pick_up_address'     =>@$getBookingDetail->job->pick_up_address,
                        'total_goods_weight'  =>@$getBookingDetail->job->total_goods_weight,
                        'description_of_goods'=>@$getBookingDetail->job->description_of_goods,
                        'number_of_items'     =>@$getBookingDetail->job->number_of_items, 

                        'sub_amount'          =>@$getBookingDetail->quote_amount,
                        'status'              =>@$getBookingDetail->job->status, 
                        'city'                =>$user->language_code=="ar"?@$getBookingDetail->pickupSubRegion->arabic_name:@$getBookingDetail->pickupSubRegion->name,

                    ],
                    'tota'=>[
                        'sub_amount'            =>@$getBookingDetail->quote_amount,
                        'discount'              =>@$getBookingDetail->discount,
                        'tax_price'             =>@$getBookingDetail->tax_price,
                        'booking_fee'           =>@$getBookingDetail->booking_fee,
                        'commssion'             =>@$commission,
                        'penaltiy_amount'       =>@$getBookingDetail->penaltiy_amount,


                    ],
                    'jobReceivers' =>$jobReceivers
                ]; 


                $emailData['email']    =  $getBookingDetail->user->email;         

                $emailData['subject']  =  'Service invoice';
                $emailData['data']     =  $data;

                if ($user->language_code=="ar") {        
                    $view                  =  'emails.email_invoice-ar';
                }else{
                    $view                  =  'emails.email_invoice'; 
                }

               sendMail($view,$emailData);

                $getUser   = User::where('id',$user->id)->where('login_status','1')->where('status','1')->where('is_push_notifications','1')->first(); 

                $getdriver   = User::where('id', $quote->driver_id)->where('login_status','1')->where('status','1')->where('is_push_notifications','1')->first(); 
                
                $gettransporter  = User::where('id',@$getdriver->parent_id)->where('login_status','1')->where('status','1')->where('is_push_notifications','1')->first(); 
               

                if (isset($getdrivers->fcmTokens)) {

                    if($getdrivers->language_code=="ar")
                    {
                        $title ="تم قبول سعرك من قبل العميل";
                        $body  ="تم قبول السعر الذي قدمته من قبل العميل وبإمكانك الاطلاع على التفاصيل في صفحة الحمولات النشطة";
                    }else if($getdrivers->language_code=="ur"){
                        $title  ="آپ کی قیمت کی پیشکش قبول کر لی گئی ہے۔";
                        $body  = "";
                    }else{
                        $title ="Your Quote Has Been Accepted";
                        $body = "The user has accepted your price offer";
                    }

                    Notifica::create([
                        'sender_id'     =>Auth()->user()->id, 
                        'receiver_id'   => $quote->driver_id, 
                        'action_id'      =>$quote->job_id,               
                        
                        'type'          =>'Quote', 
                        'isRead'        =>'0',
                        'title'         =>"Your Quote Has Been Accepted", 
                        'description'   =>"The user has accepted your price offer",
                        'title_arabic'  =>"تم قبول سعرك من قبل العميل",
                        'description_arabic' =>"تم قبول السعر الذي قدمته من قبل العميل وبإمكانك الاطلاع على التفاصيل في صفحة الحمولات النشطة",
                    ]);   
                    foreach($getdrivers->fcmTokens as $key=> $token){
                        if($token->token_type==='ios'){
                            $data=[
                                'title'        =>  $title, 
                                'body'         => 'Your quote has been accepted',             
                                'html'         => 'HTML',
                                'id'           =>  $quote->job_id,
                                'type'         =>  2,
                                "badge_count"   => $getdrivers->badge_count,
                                "account_type"   => $getdrivers->account_type,
                            ];
                            
                            $datess = iosPushNotification($token->token, $title, $body,$data);
                        }else{
                            Notification::send($getdrivers, new \App\Notifications\QuoteAccepted($quote->job_id, $title, $body)); 
                        }                        
                    }
                }
                if (isset($getTransporter->fcmTokens)) {

                    if($getTransporter->language_code=="ar")
                    {
                        $title ="تم قبول سعرك من قبل العميل";
                        $body  ="تم قبول السعر الذي قدمته من قبل العميل وبإمكانك الاطلاع على التفاصيل في صفحة الحمولات النشطة";
                    }else if($getTransporter->language_code=="ur"){
                        $title  ="آپ کی قیمت کی پیشکش قبول کر لی گئی ہے۔";
                        $body  = "";
                    }else{
                        $title ="Your Quote Has Been Accepted";
                        $body = "The user has accepted your price offer";
                    }

                    Notifica::create([
                        'sender_id'     =>Auth()->user()->id, 
                        'receiver_id'   => $getTransporter->id, 
                        'action_id'      =>$quote->job_id,    
                        'type'          =>'Quote', 
                        'isRead'        =>'0',
                        'title'         =>"Your Quote Has Been Accepted", 
                        'description'   =>"The user has accepted your price offer",
                        'title_arabic'  =>"تم قبول سعرك من قبل العميل",
                        'description_arabic' =>"تم قبول السعر الذي قدمته من قبل العميل وبإمكانك الاطلاع على التفاصيل في صفحة الحمولات النشطة",
                    ]); 
        
                    foreach($getTransporter->fcmTokens as $key=> $token){
                        if($token->token_type==='ios'){
                            $data=[
                                'title'        => $title, 
                                'body'         => 'Your quote has been accepted',             
                                'html'         => 'HTML',
                                'id'           =>  $quote->job_id,
                                'type'         =>  2,
                                "badge_count"   => $getTransporter->badge_count,
                                "account_type"   => $getTransporter->account_type,
                            ];                        
                            $datess = iosPushNotification($token->token,$title,$body,$data);
                        }else{
                            Notification::send($getTransporter, new \App\Notifications\QuoteAccepted($quote->job_id,$title,$body)); 
                        }                        
                    }
                }
                $senddriverSMS = User::where('id',$quote->driver_id)->first(); 
                sendSMSAcceptJobToTransporter($senddriverSMS->transporter->phone_number,$senddriverSMS->transporter->name,$quote->job_id);
                sendSMSAcceptJobToDriver($senddriverSMS->phone_number,$senddriverSMS->name,$quote->job_id); 


                /************ */
                if (isset($getUser->fcmTokens)) {

                    if($getUser->language_code=="ar")
                    {
                        $title ="تم الحجز بنجاح!";
                        $body  ="تم تقديم طلبك بنجاح وبانتظار التسعير من ناقلين";
                    }else if($getUser->language_code=="ur"){
                        $title  ="آپ کی ریزرویشن کامیاب ہو گئی ہے!";
                        $body  = "";
                    }else{
                        $title ="Your Job Booked Successfully";
                        $body = "Your requested is booked and sent to transporters";
                    }
                    foreach($getUser->fcmTokens as $key=> $token){
                        if($token->token_type==='ios'){
                            $data=[                                
                                'title'        =>  $title, 
                                'body'         => 'Your job successfully booked.',             
                                'html'         => 'HTML',
                                'id'           =>  $quote->job_id,
                                'type'         =>  1,
                                'service_type' => 'test_data',
                                'account_type' =>  $getUser->account_type,                            
                            ];
                            $datess = iosPushNotification($token->token,$title, $body,$data);
                        }else{
                            Notification::send($getUser, new \App\Notifications\Booking($quote->job_id,$title, $body));
                        }
                    }  

                    Notifica::create([
                        'sender_id'     =>$user->id, 
                        'receiver_id'   =>$user->id,  
                        'action_id'      =>$quote->job_id,
                        'type'          =>'booking', 
                        'isRead'        =>'0',
                        'title'         =>"Your Job Booked Successfully", 
                        'description'   =>"Your requested is booked and sent to transporters",
                        'title_arabic'       =>"تم الحجز بنجاح!",
                        'description_arabic' =>"تم تقديم طلبك بنجاح وبانتظار التسعير من ناقلين",
                    ]);
                }  
              

                if (isset($getdriver->fcmTokens)) {
                    if($getdriver->language_code=="ar")
                    {
                        $title ="الآن تم تكليفك بالمهمة";
                        $body  ="الآن تم تكليفك بمهمة النقل ويمكنك الاطلاع على التفاصيل في الحمولات النشطة";
                    }else if($getdriver->language_code=="ur"){
                        $title  ="اب آپ کو ملازمت تفویض کی گئی ہے۔";
                        $body  = "";
                    }else{
                        $title ="Now Job Assigned to You";
                        $body = "The transporter has assigned a task to you";
                    }
                    foreach($getdriver->fcmTokens as $key=> $tokent){
                        if($tokent->token_type==='ios'){
                            $data=[
                                'title'        =>  $title, 
                                'body'         => 'New job assigned',             
                                'html'         => 'HTML',
                                'id'           =>  $quote->job_id,
                                'type'         =>  1,
                                'service_type' => 'test_data',
                                'account_type' =>  $getdriver->account_type,
                            ];
                            
                            $datess = iosPushNotification($tokent->token, $title,$body,$data);
                        }else{
                            Notification::send($getdriver, new \App\Notifications\TransporterAssignment($quote->job_id, $title,$body));
                        }
                    } 

                    Notifica::create([
                        'sender_id'     =>$user->id, 
                        'receiver_id'   => $quote->driver_id,
                        'action_id'   => $quote->job_id,
                        'type'          =>'Job', 
                        'isRead'        =>'0',
                        'title'         =>"Now Job Assigned to You", 
                        'description'   =>"The transporter has assigned a task to you",
                        'title_arabic'       =>"الآن تم تكليفك بالمهمة",
                        'description_arabic' =>"الآن تم تكليفك بمهمة النقل ويمكنك الاطلاع على التفاصيل في الحمولات النشطة",
                    ]); 
                }                

                if (isset($gettransporter)) {
                    if($gettransporter->language_code=="ar")
                    {
                        $title ="الآن تم تكليفك بالمهمة";
                        $body  ="الآن تم تكليفك بمهمة النقل ويمكنك الاطلاع على التفاصيل في الحمولات النشطة";
                    }else if($gettransporter->language_code=="ur"){
                        $title  ="اب آپ کو ملازمت تفویض کی گئی ہے۔";
                        $body  = "";
                    }else{
                        $title ="Now Job Assigned to You";
                        $body = "The transporter has assigned a task to you";
                    }
                    if (isset($gettransporter->fcmTokens)) {
                        foreach($gettransporter->fcmTokens as $key=> $tokent){
                            if($tokent->token_type==='ios'){
                                $data=[
                                    'title'        =>$title, 
                                    'body'         => 'Driver Assigned',             
                                    'html'         => 'HTML',
                                    'id'           =>  $getBooking->job_id,
                                    'type'         =>  1,
                                    'service_type' => 'test_data',
                                    'account_type' =>  $gettransporter->account_type,
                                ];
                                $datess = iosPushNotification($tokent->token,$title,$body,$data);
                            }else{
                                Notification::send($gettransporter, new \App\Notifications\DriverAssignment($getBooking->job_id,$title,$body));
                            }
                        } 
                    }  
                    Notifica::create([
                        'sender_id'     =>$user->id, 
                        'receiver_id'   => $gettransporter->id,               
                        'title'         =>"New job assigned", 
                        'action_id'     => $getBooking->job_id,
                        'type'          =>'booking', 
                        'isRead'        =>'0',
                        'description'   =>"New Job Assigned successfully",
                        'title_arabic'       =>"تعيين وظيفة جديدة",
                        'description_arabic' =>"تم تعيين وظيفة جديدة بنجاح",
                    ]); 
                    

                }
            }
        }       
    }


    public function pendingPaymentApprove(Request $request){

        if(!empty($request->quote_id)){

            $approvePaymentData = ReceiveQuotes::where('id',$request->quote_id)->first();
            $getJob       = Job::where('id',$approvePaymentData->job_id)->first(); 
            $approvePayment = ReceiveQuotes::where('id',$request->quote_id)->update(['approved_by_admin'=>'yes']);  
            $this->bookingNew($request->quote_id);
            
            $quoteCount = 1;
            $driver_merge = [$approvePaymentData->user_id, $approvePaymentData->driver_id];

            $drivers = User::whereIN('id',$driver_merge)->get();
 
            if (count($drivers)) {

                foreach ($drivers as $key => $value) {

                    $getdrivers = User::where('id',$value->id)->where('is_push_notifications','1')->first();                     

                    $getTransporter   = User::where('id',$getdrivers->parent_id)->where('status','1')->where('account_type','2')->where('is_push_notifications','1')->first();  

                    
                }
            }

            if($approvePayment){
                return 1;
            }else{
                return 2;
            }

        }
    }






 public function booking(Request $request ,$userData) 
    {
        Log::info($request->all()); 

        $quote = ReceiveQuotes::where('id',$request->quote_id)->where('user_id',$userData->id)
        ->isExpired()->where('status','payment-pending')->with('driver','job')->first();

        if ($quote) {

            $vehicle     =  Vehicle::where('driver_id',$quote->driver->id)->with('vehicleType')->first();
            $jobReceiver =  JobReceiver::where('job_id',$quote->job_id)->orderBy('id', 'ASC')->get();

           // quote_amount
            $data = json_decode($quote->data, true);
            $pay_amount = @$data['total_amount'];

            $getResponse = $this->makePayment($request,$pay_amount);  


            // if (@$getResponse['approved']) {
            if (true) {  // bypassing the payment

                $bookings = IdGenerator::generate(
                    [
                        'table' => 'bookings',
                        'field' =>'book_id', 
                        'length'=>12, 
                        'prefix'=>'ORD-'
                    ]);

                $booking=[
                    'book_id'           =>$bookings,
                    'booked_on'         =>Carbon::now(),
                    'driver_id'         => $quote->driver_id,
                    'job_id'            =>$quote->job_id,
                    'quote_id'          => $quote->id,
                    'user_id'           => auth()->user()->id,
                    'status'            =>"not_started_yet",
                    'transporter_name'  =>@ $quote->driver->name,
                    'booking_fee'       =>@$getResponse['amount']/100,
                    'date_of_service'   =>@$quote->job->schedule_date,
                    'time_of_service'   =>@$quote->job->schedule_time,
                    'vehicle_make'      =>@$vehicle->vehicle_registration_year,
                    'vehicle_colour'    =>@$vehicle->Vehicle_colour,
                    'license_plate'     =>@$vehicle->license_plate,
                    'vehicle_name'      =>@$vehicle->vehicleType->name,
                    'mobile_number'     =>@$quote->driver->phone_number,
                    'pick_up_region_id' =>@$quote->job->pick_up_region_id,
                    'pick_up_sub_region_id'=>@$quote->job->pick_up_sub_region_id,                    
                    'pick_up_latitude'  =>@$quote->job->pick_up_lat,
                    'pick_up_longitude' =>@$quote->job->pick_up_long,
                    'payment_status'    =>"success",
                    'quote_amount'      =>@$data['quote_amount'],
                    'discount'          =>@$data['discount'],
                    'tax_price'         =>@$data['tax_price'],
                    'penaltiy_amount'   =>@$data['penaltiy'],


                ];               


                $getBooking = Booking::create($booking);

                if (Booking::where('user_id',auth()->user()->id)->count()==1) {
                    $greferrer = User::where('id',auth()->user()->id)->where('referrer_id','!=','')->first();

                    if ($greferrer) {
                        if (ReferrerWallet::where('user_id',auth()->user()->id)->doesntExist()) {
                            $data=[
                                'user_id'       =>auth()->user()->id,
                                'earn'   =>5,
                                'spend'   =>'',
                            ];
                            ReferrerWallet::create($data);
                        }else{
                            ReferrerWallet:: where('user_id',auth()->user()->id)->increment('earn', 5);
                        }
                        if (ReferrerWallet::where('user_id',$greferrer->referrer_id)->doesntExist()) {
                            $data=[
                                'user_id'       =>$greferrer->referrer_id,
                                'earn'   =>5,
                                'spend'   =>'',
                            ];
                            ReferrerWallet::create($data);
                        }else{
                            ReferrerWallet:: where('user_id',$greferrer->referrer_id)->increment('earn', 5);
                        }
                    }
                }



                $tracking_id =(dechex($getBooking->id).uniqid());

                $getBooking->update([
                    'tracking_id' =>$tracking_id,
                    'invoice_no' =>'invoice-'.date('Yms').$getBooking->id,

                ]);


                $message = 'Booking No:'.$getBooking->book_id.' (Arabat) has been booked on '.$getBooking->booked_on.'. Track your Booking @  '.env('STORAGE_PATH').'track-order/'.$tracking_id;

                foreach ($jobReceiver as $key => $jobReceivervalue) {

                    sendWhatsappMessage('+966' ,$jobReceivervalue->receiver_number,$message);

                }

                UserCancelJobPenality::where('user_id',auth()->user()->id)
                ->where('job_id',$quote->job_id)->update(['status'=>0]);

                ReceiveQuotes::where('id',$request->quote_id)->where('user_id',auth()->user()->id)->update(['status'=>'accepted']);

                RequestQuotes::whereNotIn('driver_id',[$quote->driver_id])
                ->whereNotIn('status',['quote_post'])
                ->where('job_id',$quote->job_id)->update(['status'=>'closed']);

                RequestQuotes::where('driver_id',$quote->driver_id)->where('job_id',$quote->job_id)->update(['status'=>'accepted']);

                $transactions =[
                    'booking_id'    =>$getBooking->id,
                    'job_id'        =>$quote->job_id,
                    'driver_id'     =>$quote->driver_id,
                    'user_id'       =>$quote->user_id,
                    'transaction_id'=>@$getResponse['id'],
                    'booked_on'     =>@$getResponse['processed_on'],
                    'amount'        =>@$getResponse['amount']/100,
                    'status'        =>@$getResponse['status'],
                    'approved'      =>@$getResponse['approved'],
                    'customer'      =>@$getResponse['customer']['id'],
                    'customer_email'=>@$getResponse['customer']['email'],
                    'response'      =>json_encode($getResponse),
                    'bank_account_id'  =>@$getResponse['bank_account_id'],
                    'bank_name'        =>@$getResponse['bank_name'],
                    'account_info'     =>@$getResponse['account_info'],
                    'bank_rceipt'      =>@$getResponse['bank_rceipt'],
                    'remitter_name'    =>@$getResponse['remitter_name'],
                ];   

                Transaction::create($transactions);

                BookingStatusUpdate::insert([
                    'booking_id' =>$getBooking->id,
                    'driver_id'  =>$quote->driver_id,
                    'status'     =>'not_started_yet',

                ]);




                $booking  =  Booking::where('id',$getBooking->id)
                ->with('driver',function($q){
                    $q->with('transporter');
                })
                ->with('job')        
                ->first();                 
                $country_code         =$booking->driver->country_code;
                $number         =$booking->driver->phone_number;
                $message        ='Client mobile number : '.Auth()->user()->phone_number .' and pickup address : '  . $booking->job->pick_up_address;
                sendWhatsappMessage($country_code,$number,$message);



                $getBookingDetail =Booking::where('id',$getBooking->id)->with('user','driver','job')->first();
                $jobReceivers =JobReceiver::with('DestinationAddres')->where('job_id',$getBookingDetail->job_id)->get();


                
                $pricing    =   Pricing::first();
                $commission=(($getBookingDetail->quote_amount*$pricing->online_payment_discount)/100)*(1+$pricing->tax/100); 


                $checkUserCommission = User::select('commission')->where('id',auth()->user()->id)->first();

                if(!empty($checkUserCommission)){
                    $userCommission =$checkUserCommission->commission;

                    if($userCommission!='' && $userCommission!=null){ 
                        
                        $commission=(($getBookingDetail->quote_amount*$userCommission)/100)*(1+$pricing->tax/100);

                    }
                }
 

                if($getBookingDetail->job->product->name=='Other') {
                    $title=$getBookingDetail->job->other;

                }else{
                    $title=Auth()->user()->language_code=="ar"?$getBookingDetail->job->product->arabic_name:$getBookingDetail->job->product->name;

                }

                $data=[
                    'book_id'      =>$getBookingDetail->book_id,
                    'booked_on'    =>$getBookingDetail->booked_on,
                    'invoice_no'   =>$getBookingDetail->invoice_no,
                    'booking_status' =>$getBookingDetail->status, 
                    'user'=>[
                        'name'                =>@$getBookingDetail->user->name,
                        'email'               =>@$getBookingDetail->user->email, 
                        'phone_number'        =>@$getBookingDetail->user->country_code.@$getBookingDetail->user->phone_number,
                        'city'                =>@$getBookingDetail->user->city, 
                    ],
                    'transporter'=>[
                        "name"=>@$getBookingDetail->driver->transporter->name,
                        "pta_license_number"=>@$getBookingDetail->driver->transporter->transporterDetails->pta_license_number,

                    ],
                    'driver'=>[
                        'name'                =>@$getBookingDetail->driver->name,
                        'email'               =>@$getBookingDetail->driver->email, 
                        'phone_number'        =>@$getBookingDetail->driver->country_code.@$getBookingDetail->driver->phone_number,
                        'city'                =>@$getBookingDetail->driver->city,
                    ], 
                    'job'=>[
                        'title'               =>@$title,
                        'job_id'              =>@$getBookingDetail->job->job_ID,
                        'schedule_date'       =>@$getBookingDetail->job->schedule_date,
                        'schedule_time'       =>@$getBookingDetail->job->schedule_time,
                        'vehicle_type'        =>@$getBookingDetail->vehicle_name, 

                        'pick_up_address'     =>@$getBookingDetail->job->pick_up_address,
                        'total_goods_weight'  =>@$getBookingDetail->job->total_goods_weight,
                        'description_of_goods'=>@$getBookingDetail->job->description_of_goods,
                        'number_of_items'     =>@$getBookingDetail->job->number_of_items, 

                        'sub_amount'          =>@$getBookingDetail->quote_amount,
                        'status'              =>@$getBookingDetail->job->status, 
                        'city'     =>Auth()->user()->language_code=="ar"?@$getBookingDetail->pickupSubRegion->arabic_name:@$getBookingDetail->pickupSubRegion->name,

                    ],
                    'tota'=>[
                        'sub_amount'            =>@$getBookingDetail->quote_amount,
                        'discount'              =>@$getBookingDetail->discount,
                        'tax_price'             =>@$getBookingDetail->tax_price,
                        'booking_fee'           =>@$getBookingDetail->booking_fee,
                        'commssion'             =>@$commission,
                        'penaltiy_amount'       =>@$getBookingDetail->penaltiy_amount,


                    ],
                    'jobReceivers' =>$jobReceivers
                ]; 

                // $emailData['email']    =  $getBookingDetail->user->email;         

                // $emailData['subject']  =  'Service invoice';
                // $emailData['data']     =  $data;

                // if (Auth()->user()->language_code=="ar") {        
                //     $view                  =  'Emails.email_invoice-ar';
                // }else{
                //     $view                  =  'Emails.email_invoice';
                // }
                // sendMail($view,$emailData);





                $getUser   = User::where('id',auth()->user()->id)->where('login_status','1')->where('status','1')->where('is_push_notifications','1')->first(); 

                $getdriver   = User::where('id', $quote->driver_id)->where('login_status','1')->where('status','1')->where('is_push_notifications','1')->first(); 
                
                $gettransporter  = User::where('id',@$getdriver->parent_id)->where('login_status','1')->where('status','1')->where('is_push_notifications','1')->first(); 

                if (isset($getUser->fcmTokens)) {
                    foreach($getUser->fcmTokens as $key=> $token){
                        if($token->token_type==='ios'){
                            $data=[
                                'title'        => 'Booking successfull', 
                                'body'         => 'Your job successfully booked.',             
                                'html'         => 'HTML',
                                'id'           =>  $quote->job_id,
                                'type'         =>  1,
                                'service_type' => 'test_data',
                                'account_type' =>  $getUser->account_type,
                            ];
                            $datess = iosPushNotification($token->token,"Booking successfull","Your job successfully booked",$data);
                        }else{

                            Notification::send($getUser, new \App\Notifications\Booking($quote->job_id));
                        }
                    }  
                }  

               // Notification::send($getUser, new \App\Notifications\Booking($quote->job_id));

                Notifica::create([
                    'sender_id'     =>Auth()->user()->id, 
                    'receiver_id'   =>Auth()->user()->id,  
                    'action_id'      =>$quote->job_id,            
                    'title'         =>"booking successful", 
                    'type'          =>'booking', 
                    'isRead'        =>'0',
                    'description'   =>"Booking successfully",
                    'title_arabic'       =>"تم الحجز بنجاح",
                    'description_arabic' =>"تم الحجز بنجاح",
                ]);
                if (isset($getdriver->fcmTokens)) {
                    foreach($getdriver->fcmTokens as $key=> $tokent){
                        if($tokent->token_type==='ios'){
                            $data=[
                                'title'        => 'New job assigned', 
                                'body'         => 'New job assigned',             
                                'html'         => 'HTML',
                                'id'           =>  $quote->job_id,
                                'type'         =>  1,
                                'service_type' => 'test_data',
                                'account_type' =>  $getdriver->account_type,
                            ];
                            $datess = iosPushNotification($tokent->token,"New job assigned","New job assigned",$data);
                        }else{
                         Notification::send($getdriver, new \App\Notifications\TransporterAssignment($quote->job_id));
                     }
                 } 
             } 

            // Notification::send($getdriver, new \App\Notifications\TransporterAssignment($quote->job_id));

             Notifica::create([
                'sender_id'     =>Auth()->user()->id, 
                'receiver_id'   => $quote->driver_id,
                'action_id'   => $quote->job_id,               
                'title'         =>"New job assigned", 
                'type'          =>'Job', 
                'isRead'        =>'0',
                'description'   =>"New Job Assigned successfully",
                'title_arabic'       =>"تعيين وظيفة جديدة",
                'description_arabic' =>"تم تعيين وظيفة جديدة بنجاح",
            ]);  


             if (isset($gettransporter)) {
              if (isset($gettransporter->fcmTokens)) {
                foreach($gettransporter->fcmTokens as $key=> $tokent){
                    if($tokent->token_type==='ios'){
                        $data=[
                            'title'        => 'Driver Assigned', 
                            'body'         => 'Driver Assigned',             
                            'html'         => 'HTML',
                            'id'           =>  $getBooking->job_id,
                            'type'         =>  1,
                            'service_type' => 'test_data',
                            'account_type' =>  $gettransporter->account_type,
                        ];
                        $datess = iosPushNotification($tokent->token,"Driver Assigned","Driver Assigned",$data);
                    }else{
                       Notification::send($gettransporter, new \App\Notifications\DriverAssignment($getBooking->job_id));
                   }
               } 
           } 
                //Notification::send($gettransporter, new \App\Notifications\DriverAssignment($getBooking->job_id));
           Notifica::create([
            'sender_id'     =>Auth()->user()->id, 
            'receiver_id'   => $gettransporter->id,               
            'title'         =>"New job assigned", 
            'action_id'     => $getBooking->job_id,
            'type'          =>'booking', 
            'isRead'        =>'0',
            'description'   =>"New Job Assigned successfully",
            'title_arabic'       =>"تعيين وظيفة جديدة",
            'description_arabic' =>"تم تعيين وظيفة جديدة بنجاح",
        ]); 

       } 






       return response()->json([ 
        'status'  => 200,
        'message' => 'booking_successfully',
        'data'    =>[               
            'booking' => $getBooking,                        
            'message' => $message,                        
        ]
    ]); 

   }else{

    return response()->json([ 
        'status'     => 400,
        'error_type' => $getResponse['error_type'],
        'message'    => trim(str_replace('_',' ',implode('',$getResponse['error_codes']))),
        'data'       => Null
    ]);  
}  
}else{

    return response()->json([ 
        'status'  => 200,
        'message' => 'quote_expired',
        'data'    =>Null
    ]);
}
}
















    public function getTransporterList(Request $request){

        $getVehicleList = Job::where('id',$request->job_id)->pluck('vehicle_type_id');

        $getDriverList = Vehicle::whereIn('vehicle_type_id',$getVehicleList)->pluck('driver_id');

        $getTransportersIds = User::whereIn('id',$getDriverList)->pluck('parent_id');

        $getTransportersLists = User::whereIn('id',$getTransportersIds)->get();
         // echo '<pre>'; print_r($getTransportersList); die;
        $html='';

        foreach($getTransportersLists as $getTransportersList){

            $html.='<option value='.$getTransportersList->id.'>'.$getTransportersList->name.'</option>';
        }
        return $html;
    }

        public function expiredJobSent(Request $request)
        {   
            $user = Job::where('id',$request->job_id)->first();

            $vehicleTypeId =explode(',', $user->vehicle_type_id);

             // Calculate distance using Haversine formula

            $distanceFormula = '(3959 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(`long`) - radians(?)) + sin(radians(?)) * sin(radians(lat))))';

            // Retrieve drivers within a certain distance
            $getDriverList = User::select('users.*')
                ->selectRaw($distanceFormula . ' AS distance', [$user->pick_up_lat, $user->pick_up_long, $user->pick_up_lat])
                ->join('vehicles', 'users.id', '=', 'vehicles.driver_id')
                ->whereIn('parent_id', $request->transporter_id)
                ->where('vehicles.status', '1')
                ->whereIn('vehicles.vehicle_type_id', $vehicleTypeId)
                ->havingRaw('distance <= 100')
                ->groupBy('users.id')
                ->pluck('id');

            $getDriversRecord = RequestQuotes::where('job_id', $request->job_id)
            // ->whereIn('driver_id', $getDriverList)
            ->delete();

            // Create new records for selected drivers
            if ($getDriverList->isNotEmpty()) {
                foreach ($getDriverList as $getDriver) {
                    RequestQuotes::create([
                        'user_id' => $user->user_id,
                        'job_id' => $request->job_id,
                        'driver_id' => $getDriver,
                        'is_active_date' => $user->is_active_date,
                        'admin_assignjob_to_transporter' => '1',
                    ]);
                }
            }
        
            return redirect()->back()->with('success','Job Sent successfully');
            
        }

        public function manuallyJob(Request $request){
        
        if ($request->ajax()) { 

            $data =Job::where('created_by','Admin')->with('product','PickupRegion','PickupSubRegion','JobReceiver')
            ->with('JobReceiver',function($q){
                $q->with('DestinationRegion');

            })

            ->orderBy('id','DESC');
            
            if (!empty($request->date_range[0])) {
                $date_range = $request->date_range; 
                $data->whereDate('created_at','>=',date('Y-m-d',strtotime($date_range[0])))
                ->whereDate('created_at','<=',date('Y-m-d',strtotime($date_range[1])));
            }
            
            if (!empty($request->job_status)) {
                
                $data->where('status',$request->job_status);
                
            }
            

            $getData=$data->get();

            return Datatables::of($getData)
            ->addIndexColumn()

            ->addColumn('schedule_date', function($row){
                $btn =  date('d/m/Y',strtotime($row->schedule_date)) ;
                return $btn;
            })
            ->addColumn('schedule_time', function($row){
                $btn =  date('h:i A',strtotime($row->schedule_time)) ;
                return $btn;
            })
            ->addColumn('pick_up_address', function($row){
                $btn =   @$row->PickupSubRegion->name .','.@$row->PickupRegion->name;
                return $btn;
            }) 

            ->addColumn('destination_address', function($row){
                $btn =   @$row->JobReceiver->DestinationSubRegion->name .','.@$row->JobReceiver->DestinationRegion->name ;  


                return $btn;
            }) 


            ->addColumn('number_of_vehicle', function($row){
                $btn =   @$row->number_of_vehicle ;
                return $btn;
            })
            ->addColumn('status', function($row){
                $btn =  ucfirst($row->status) ;
                return $btn;
            })



            ->addColumn('action', function($row){

                $btn1=$btn2=$btn3='';
                if(auth()->user()->can('view_jobs'))
                {
                    $btn1= '<a class="action-button" title="View" href='.route('jobs.show',$row->id).'><i class="text-info fa fa-eye"></i></a>';
                }

                if(auth()->user()->can('delete_jobs'))
                {
                    $btn3=  '<a class="action-button delete-button "   id="'.$row->id.'"  onclick="deleteJob('.$row->id.')" title="Delete" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt" style="padding:4px;"></i></a>';
                }
                $btn2=  '<a class="action-button pay-button " data-toggle="modal" data-target="#modalLoginForm"  id="'.$row->id.'"   title="Pay Amount" href="javascript:void(0)" data-id="'.$row->id.'" data-user_id="'.$row->user_id.'" data-created_by="'.$row->created_by.'"><i class="text-info fa fa-stripe" style="padding:4px;"></i></a>';
                $btn4='';
                $btn5='';
                if($row->created_by=='Admin'){
                $btn4=  '<a class="action-button" title="Edit" href="edit-job?job_id='.$row->id.'"><i class="text-warning fa fa-edit" style="padding:4px;"></i></a>';
                $btn5=  '<a class="action-button cancel-button "   id="'.$row->id.'"  onclick="cancelJob('.$row->id.')" title="Cancel" href="javascript:void(0)" data-id=""><i class="fa fa-ban" style="padding:4px;"></i></a>';
                }
                
                return $btn1.$btn2.$btn4.$btn3.$btn5;
            }) 


            ->rawColumns(['schedule_date','schedule_time','pick_up_address','destination_address','number_of_vehicle','status','action'])
            ->make(true);
        }

        return view('jobs.manuallyjob');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        $getVehicleType =VehicleType::where('status','1')->get();
        $getProduct=Product::get();
        $getRegion=Region::where('status','1')->get();
        $getUsers=User::select('*')->where('role_id',Config::get('variables.User'))->where('status','1')->get();
        $getTransporters=User::select('*')->where('role_id',Config::get('variables.Transporter'))->where('status','1')->get();

        return view('jobs.create',compact('getVehicleType','getProduct','getRegion','getUsers','getTransporters'));
    }

     public function create2()
    {
         
        $getVehicleType =VehicleType::where('status','1')->get();
        $getProduct=Product::get();
        $getRegion=Region::where('status','1')->get();
        $getUsers=User::select('*')->where('role_id',Config::get('variables.User'))->where('status','1')->get();
        $getTransporters=User::select('*')->where('role_id',Config::get('variables.Transporter'))->where('status','1')->get();

        return view('jobs.create2',compact('getVehicleType','getProduct','getRegion','getUsers','getTransporters'));
    }

     public function create3()
    {
        $job_id=$_GET['job_id']; 
        $getJobData =Job::where('id',$job_id)->get();  
        $getBookingData=Booking::where('job_id',$job_id)->get();
        $getJobReceiverData=JobReceiver::where('job_id',$job_id)->get();
        $getUserData =User::where('id',$getJobData[0]['user_id'])->get();
        $getDriverData = DB::table('users')->where('id',$getBookingData[0]['driver_id'])->get();

        // echo '<pre>';print_r($getDriverData[0]); die;
        $getVehicleType =VehicleType::where('id',$getJobData[0]['vehicle_type_id'])->get();
        $getProduct=Product::get();
        $getRegion=Region::where('status','1')->get();
        $getRegion=Region::where('status','1')->get();
        $getUsers=User::select('*')->where('role_id',Config::get('variables.User'))->where('status','1')->get();
        $getTransporters=User::select('*')->where('role_id',Config::get('variables.Transporter'))->where('status','1')->get();
        $getTransporters=User::select('*')->where('role_id',Config::get('variables.Transporter'))->where('status','1')->get();

        $jobsPaymentDetails=JobsPaymentDetails::where('job_id',$job_id)->first();

        return view('jobs.create3',compact('getJobData','getBookingData','getJobReceiverData','getUserData','getDriverData','getVehicleType','getProduct','getRegion','getUsers','getTransporters','jobsPaymentDetails'));
    }


  public function editJob()
    {
        $job_id=$_GET['job_id']; 
        $getJobData =Job::where('id',$job_id)->get();  
        $getBookingData=Booking::where('job_id',$job_id)->get();
        $getJobReceiverData=JobReceiver::where('job_id',$job_id)->get();
        $getUserData =User::where('id',$getJobData[0]['user_id'])->get();
        $getDriverData =User::where('id',$getBookingData[0]['driver_id'])->get();

        // echo '<pre>';print_r($getBookingData); die;
        $getVehicleType =VehicleType::where('id',$getJobData[0]['vehicle_type_id'])->get();
        $getProduct=Product::get();
        $getRegion=Region::where('status','1')->get();
        $getUsers=User::select('*')->where('role_id',Config::get('variables.User'))->where('status','1')->get();
        $getTransporters=User::select('*')->where('role_id',Config::get('variables.Transporter'))->where('status','1')->get();
        $getTransporters=User::select('*')->where('role_id',Config::get('variables.Transporter'))->where('status','1')->get();

        $getVehicles  = Vehicle::where('transporter_id',$getJobData[0]->transporter_id)->pluck('vehicle_type_id');
        $getVehiclesTypes = VehicleType::WhereIn('id',$getVehicles)->get();
        $getVehiclesNumbers  = Vehicle::where('transporter_id',$getJobData[0]->transporter_id)->where('vehicle_type_id',$getJobData[0]['vehicle_type_id'])->get();

        $getDriverIds  = Vehicle::where('transporter_id',$getJobData[0]->transporter_id)->where('vehicle_type_id',$getJobData[0]['vehicle_type_id'])->pluck('driver_id');
        $getdrivers   = User::select('id','name','phone_number')->WhereIn('id',$getDriverIds)->get();
        


        return view('jobs.edit-job',compact('getJobData','getBookingData','getJobReceiverData','getUserData','getDriverData','getVehicleType','getProduct','getRegion','getUsers','getTransporters','getVehiclesTypes','getVehiclesNumbers','getdrivers'));
    }




     public function downloadPastInvoice()
    {
        $getJobsManually= Job::select('id','job_ID')->where('created_by','Admin')->orderBy('id', 'DESC')->get();
        return view('jobs.download-past-invoice',compact('getJobsManually'));
    }

public function subRegions(Request $request)
{

    $getSubRegion=SubRegion::where('region_id',$request->region_id)->get();

    $thml ='<option value="">Select Your City</option>';
    foreach($getSubRegion as $value){

            $subRegione=$value->name;


        $thml.='<option value="'.$value->id.'">'.$subRegione.'</option>';

    }
    return $thml;

}

 


public function receiverWrap(Request $request)
{

    $number_vehicle =$request->number_vehicle;

    $getRegion=Region::where('status','1')->get();

    $html=view('user.receiver_wrap',compact('number_vehicle','getRegion'))->render();
    return $html;

}

public function jobStore(Request $request)
{

    $pickUpLat  = $request->pick_up_lat;
    $pickUpLong = $request->pick_up_long;


    $job_ID = IdGenerator::generate(
        [
            'table'  => 'jobs',
            'field'  =>'job_ID', 
            'length' =>12, 
            'prefix' =>'#ADG'
        ]);

    $scheduleDate = str_replace('/', '-', $request->schedule_date);
    $newDate = date('Y-m-d', strtotime($scheduleDate));

    if($request->number_of_vehicle==1){
        $same_receiver='yes';
    }else{
        $same_receiver=$request->same_receiver;
    }

    $data['job_ID']                =  $job_ID;
    $data['title']                 =  Product::where('id',$request->product_id)->first('name')->name;
    $data['vehicle_type_id']       =  implode(',',$request->vehicle_type_id);
    $data['number_of_vehicle']     =  $request->number_of_vehicle;
    $data['same_receiver']         =  $same_receiver;
    $data['schedule_date']         =  $newDate;
    $data['schedule_time']         =  $request->schedule_time;
    $data['total_goods_weight']    =  $request->total_goods_weight;
    $data['description_of_goods']  =  $request->description_of_goods;
    $data['number_of_items']       =  $request->number_of_items;
    $data['product_id']            =  $request->product_id;
    $data['pick_up_region_id']     =  $request->pick_up_region_id;
    $data['pick_up_sub_region_id'] =  $request->pick_up_sub_region_id;
    $data['pick_up_address']       =  $request->pick_up_address;
    $data['pick_up_lat']           =  $pickUpLat;
    $data['pick_up_long']          =  $pickUpLong; 
    $data['user_id']               =  $request->user_id;
    $data['transporter_id']        =  $request->transporter_id;
    $data['is_active_date']        =  Carbon::now()->addMinute(60);
    $data['rfq_status']            =  $request->rfq_status=='on'?'1':'0';
    $data['requirements']          =  $request->requirements;
    $data['other']                 =  @$request->other;
    $data['created_by']            =  'Admin';



   // if( $request->rfq_status=='on')
   // {

 

        $radius= Setting::first()->radius?(int)Setting::first()->radius:25;

        $data['rfq_status']            = '0';



        if ($newDate == date('Y-m-d')) {
           /* $data['is_active_date'] =  Carbon::now()->addMinute(15);
            $is_active_date =  Carbon::now()->addMinute(15); */

            $data['is_active_date'] =  sameDayTime();
            $is_active_date =  sameDayTime();

            
 

        }else{                
           /* $data['is_active_date'] =  Carbon::now()->addMinute(60);
            $is_active_date =  Carbon::now()->addMinute(60);*/

            $data['is_active_date'] =  isRFQTime();
            $is_active_date =  isRFQTime();

           
        }
        // echo '<pre>'; print_r($data); die;
        $getJob       = Job::create($data); 


        $checkUserDetails=DB::table('users')->where('id',$request->user_id)->first();
        $checkTransporterDetails=DB::table('users')->where('id',$request->transporter_id)->first();
        $vehcleDetails=DB::table('vehicle_types')->where('id',$request->vehicle_type_id)->first();


        $bookingData['book_id']='ORD-'.$getJob->id;
        $bookingData['job_id']=$getJob->id;
        $bookingData['user_id']= $request->user_id;
        $bookingData['booked_on']= date('Y-m-d H:i:s'); 
        $bookingData['approved']= '1';
        $bookingData['transporter_name']=$checkTransporterDetails->name;
        $bookingData['date_of_service']=$newDate;
        $bookingData['time_of_service']=$request->schedule_time;
        $bookingData['vehicle_name']=$vehcleDetails->name;
        $bookingData['mobile_number']=$request->receiver_number;
        $bookingData['pick_up_region_id']=$request->pick_up_region_id;
        $bookingData['pick_up_sub_region_id']=$request->pick_up_sub_region_id;
        $bookingData['pick_up_latitude']=$pickUpLat;
        $bookingData['pick_up_longitude']=$pickUpLong; 
        
        $createBoking=Booking::create($bookingData);

       //old code befor client demo
       /*$bussyDdriver = Booking::whereNotIN('status',['cancelled','service_completed'])->pluck('driver_id');

        $drivers      = User::whereNotIN('id',$bussyDdriver)
        ->whereHas('vehicle',function ($query ) use($request)
        {
            $query->where('status','1')->whereIN('vehicle_type_id',$request->vehicle_type_id);
        })
        ->where('login_status','1')
        ->where('is_online','1')
        ->where('status','1')
        ->where('account_type','4')            
        ->nearBy($pickUpLat,$pickUpLong, $radius)
        ->limit(15)
        ->inRandomOrder()             
        ->get(); */


       //new  code after client demo

        // $bussyDdriver1 = Booking::whereNotIN('status',['cancelled','service_completed'])
        // ->whereHas('driver',function ($query ) use($request)
        // {
        //     $query->whereHas('vehicle',function ($query ) use($request)
        //     {
        //       $query->where('status','1')->whereIN('vehicle_type_id',$request->vehicle_type_id);
        //   });
        // })
        // ->pluck('driver_id')->toArray();




        // $bussyDdriverPostQuotes = ReceiveQuotes::
        // whereIN('status',['pending','payment-pending','accepted','not accepted'])      
        // ->where('is_active_date','>=',Carbon::now())
        // ->whereHas('driver',function ($query ) use($request)
        // {
        //     $query->whereHas('vehicle',function ($query ) use($request)
        //     {
        //       $query->where('status','1')->whereIN('vehicle_type_id',$request->vehicle_type_id);
        //   });
        // })
        // ->pluck('driver_id')->toArray();

        //  dd($bussyDdriverPostQuotes);

        //$driver_merge = array_merge($bussyDdriver1, $bussyDdriverPostQuotes);

        // $drivers      = User::
        // whereNotIN('id',$driver_merge)
        // ->whereHas('vehicle',function ($query ) use($request)
        // {
        //     $query->where('status','1')->whereIN('vehicle_type_id',$request->vehicle_type_id);
        // })
        // ->where('login_status','1')
        // ->where('is_online','1')
        // ->where('status','1')
        // ->where('account_type','4')            
        // ->nearBy($pickUpLat,$pickUpLong, $radius)
        // ->limit(15)
        // ->inRandomOrder()             
        // ->get();



        //if (count($drivers)) {

            //$data['rfq_status']= '1';
            //$getJob->update($data);

            //$transporter_id=$driversId= $count =[];
            // foreach ($drivers as $key => $value) {

            //     if(!in_array($value->parent_id, $transporter_id)){
            //         $transporter_id[]=$value->parent_id;                         
            //     } 

            //     $driversId[]=$value->id; 

            //     $delivery_request = $getJob->requestQuotes()->create([
            //         'user_id'       =>$request->user_id, 
            //         'driver_id'     =>$value->id,
            //         'is_active_date'=> $is_active_date,
            //     ]); 

            //     Notifica::create([
            //         'sender_id'     =>$request->user_id, 
            //         'receiver_id'   => $value->id,  
            //         'action_id'     => $getJob->id,              
            //         'title'         =>"Job request", 
            //         'type'          =>'Quote', 
            //         'isRead'        =>'0',
            //         'description'   =>"New Job Request Received",
            //         'title_arabic'  =>"طلب وظيفة", 
            //         'description_arabic'   =>"تم استلام طلب عمل جديد",
            //     ]); 

            //     $quoteCount= RequestQuotes::where('driver_id',$value->id)->whereIN('status',['pending','quote_post'])
            //     ->where('is_active_date','>',Carbon::now()->subDays(1))->count();

                 
            //     // $getdrivers = User::where('id',$value->id)->where('is_push_notifications','1')->first(); 
            //     $getdrivers = User::with('fcmTokens')->where('id',$value->id)->where('is_push_notifications','1')->first();
            //     if (isset($getdrivers->fcmTokens)) {

            //         foreach($getdrivers->fcmTokens as $key=> $tokenValue){

            //             if($tokenValue->token_type==='ios'){
            //                 $data=[
            //                     'title'        => 'New Job Request Received!', 
            //                     'body'         => 'You have received a new job request',             
            //                     'html'         => 'HTML',
            //                     'id'           =>  $getJob->id,
            //                     'type'         =>  1,
            //                     'account_type' =>  $getdrivers->account_type,
            //                     'service_type' => 'test_data',
            //                     'quote_count'   => $quoteCount,
            //                 ];

            //                // $data=   iosPushNotification($tokenValue->token,"New Job Request Received!","You have received a new job request",$data);

            //             }else{
            //                 // Notification::send($getdrivers, new \App\Notifications\User\NewRequestReceived($getJob->id,$quoteCount,$getdrivers->account_type)); 

            //             }
            //         } 
            //     } 
            //            //  $quoteCounts =  Notification::send($getdrivers, new \App\Notifications\User\NewRequestReceived($getJob->id,$quoteCount,$getdrivers->account_type)); 

            // }


            // $getTransporter   = User::whereIN('id',$transporter_id) 
            // ->where('status','1')
            // ->where('account_type','2')
            // ->where('is_push_notifications','1') 
            // ->get();  
            // if (isset($getTransporter)) {
            //     foreach ($getTransporter as $key => $transporterValue) {
            //         Notifica::create([
            //             'sender_id'     =>$request->user_id, 
            //             'receiver_id'   => $transporterValue->id, 
            //             'action_id'     =>  $getJob->id,               
            //             'title'         =>"Job Request", 
            //             'type'          =>'Job', 
            //             'isRead'        =>'0',
            //             'description'   =>"New Job Request Received",
            //             'title_arabic'  =>"طلب وظيفة", 
            //             'description_arabic'   =>"تم استلام طلب عمل جديد",
            //         ]); 


            //         Notification::send($transporterValue, new \App\Notifications\User\NewRequestReceived($getJob->id,'',$transporterValue->account_type));
            //     } 
            // }
       // }



    //}else{

        //$getJob= Job::create($data);
    //}



        // $verification_code   = rand(9999,4);        
    $verification_code   = 10001;
        //$message='رمز التحقق التسليم الخاص بك هو';
        // receiverVerificationCode('966' ,$request->receiver_number,$verification_code,$message);


    $destination_sub_region = SubRegion::where('id',$request->destination_sub_region_id)->first();

    $destinationLong  =  $destination_sub_region['lat'];
    $destinationLat =    $destination_sub_region['long']; 

    $destination_address ='';

    if (isset($request->destination_address)) {

        $destination_address  =  $request->destination_address;
        $destinationLong      =  $request->destination_lat;
        $destinationLat       =  $request->destination_long;

    }

    $receiverValue['user_id']                   = $request->user_id;
    $receiverValue['job_id']                    = $getJob->id; 
    $receiverValue['receivers_name']            = $request->receiver_name;
    $receiverValue['receiver_number']           = $request->receiver_number;
    $receiverValue['destination_region_id']     = $request->destination_region_id;
    $receiverValue['destination_sub_region_id'] = $request->destination_sub_region_id;                  
    $receiverValue['destination_address']       = $destination_address;                  
    $receiverValue['destination_lat']           = $destinationLong;
    $receiverValue['destination_long']          = $destinationLat;    
    $receiverValue['verification_code']         = $verification_code; 

    $message='رمز التحقق التسليم الخاص بك هو';

       // sendWhatsappMessage('+966',$request->receiver_number,$message);
        //receiverVerificationCode('+966',$request->receiver_number,$verification_code,$message);



    JobReceiver::create($receiverValue);




    if ($request->same_receiver=='no') {

        if (count($request->receivers_name)) {

            $receiversValue=[];
            $verification_code =10002;
            foreach($request->receivers_name as $key => $valu) {

                // $verification_code =rand(9999,4);
                $message='رمز التحقق التسليم الخاص بك هو';                    

               // sendWhatsappMessage('+966',$request->receivers_number[$key],$message);

                $destinations_sub_region = SubRegion::where('id',$request->destinations_sub_region_id[$key])->first();

                $destinationLat  =  $destinations_sub_region['lat'];
                $destinationLong =  $destinations_sub_region['long']; 

                $destinationAddress ='';

                if (isset($request->receiver_address[$key])) {

                    $destinationAddress =$request->receiver_address[$key];
                    $destinationLat     =$request->receiver_lat[$key];
                    $destinationLong    =$request->receiver_long[$key];

                }

                $receiversValue['user_id']                   = $request->user_id;
                $receiversValue['job_id']                    = $getJob->id; 
                $receiversValue['receivers_name']            = $request->receivers_name[$key];
                $receiversValue['receiver_number']           = $request->receivers_number[$key];
                $receiversValue['destination_region_id']     = $request->destinations_region_id[$key];
                $receiversValue['destination_sub_region_id'] = $request->destinations_sub_region_id[$key];


                $receiversValue['destination_address']       = $destinationAddress;                  
                $receiversValue['destination_lat']           = $destinationLat;
                $receiversValue['destination_long']          = $destinationLong;  

                $receiversValue['verification_code']         = $verification_code; 

                JobReceiver::create($receiversValue);


                $verification_code = $verification_code+1;
            } 
        }
    }


    if ($getJob) {

        
         return redirect()->route('jobs.index')->with('success','Job Added successfully');

              //return  view('web.user.job-success');
    }
}


public function jobStore2(Request $request)
{
    // echo '<pre>';print_r($request->all()); die; 

    $pickUpLat  = $request->pick_up_lat;
    $pickUpLong = $request->pick_up_long;

    $destinationLat  = $request->destination_lat;
    $destinationLong = $request->destination_long;


    $job_ID = IdGenerator::generate(
        [
            'table'  => 'jobs',
            'field'  =>'job_ID', 
            'length' =>12, 
            'prefix' =>'#ADG'
        ]);

    $scheduleDate = str_replace('/', '-', $request->schedule_date);
    $newDate = date('Y-m-d', strtotime($scheduleDate));

    if($request->number_of_vehicle==1){
        $same_receiver='yes';
    }else{
        $same_receiver=$request->same_receiver;
    }

    $data['job_ID']                =  $job_ID;
    $data['title']                 =  Product::where('id',$request->product_id)->first('name')->name;
    $data['vehicle_type_id']       =  $request->vehicle_type_id;
    // $data['number_of_vehicle']     =  $request->number_of_vehicle;
    $data['same_receiver']         =  $same_receiver;
    $data['schedule_date']         =  $newDate;
    $data['schedule_time']         =  $request->schedule_time;
    $data['total_goods_weight']    =  $request->total_goods_weight;
    $data['description_of_goods']  =  $request->description_of_goods;
    $data['number_of_items']       =  $request->number_of_items;
    $data['product_id']            =  $request->product_id;
    $data['pick_up_region_id']     =  $request->pick_up_region_id;
    $data['pick_up_sub_region_id'] =  $request->pick_up_sub_region_id;
    $data['pick_up_address']       =  $request->pick_up_address;
    $data['pick_up_lat']           =  $pickUpLat;
    $data['pick_up_long']          =  $pickUpLong; 
    $data['user_id']               =  $request->user_id;
    $data['transporter_id']        =  $request->transporter_id;
    $data['is_active_date']        =  Carbon::now()->addMinute(60);
    $data['rfq_status']            =  $request->rfq_status=='on'?'1':'0';
    $data['requirements']          =  $request->requirements;
    $data['other']                 =  @$request->other;
    $data['created_by']            =  'Admin';



   // if( $request->rfq_status=='on')
   // {

 

        $radius= Setting::first()->radius?(int)Setting::first()->radius:25;

        $data['rfq_status']            = '0';



        if ($newDate == date('Y-m-d')) {
           /* $data['is_active_date'] =  Carbon::now()->addMinute(15);
            $is_active_date =  Carbon::now()->addMinute(15); */

            $data['is_active_date'] =  sameDayTime();
            $is_active_date =  sameDayTime();

            
 

        }else{                
           /* $data['is_active_date'] =  Carbon::now()->addMinute(60);
            $is_active_date =  Carbon::now()->addMinute(60);*/

            $data['is_active_date'] =  isRFQTime();
            $is_active_date =  isRFQTime();

           
        }
        // echo '<pre>'; print_r($data); die;
        $getJob       = Job::create($data); 

        $requestQuotesData['user_id']=$request->user_id;
        $requestQuotesData['job_id']=$getJob->id; 
        $requestQuotesData['driver_id']=$request->driver_id;
        $requestQuotesData['status']='accepted';
        $requestQuotesData['pending_rfq']='1';
        $requestQuotesData['is_payment']='1';
        $requestQuotesData['is_quotes_post']='1'; 
        $requestQuotesData['is_active_date']=Carbon::now()->addMinute(60);
        
        
        $request_quotes=RequestQuotes::create($requestQuotesData);

        $checkUserDetails=DB::table('users')->where('id',$request->user_id)->first();
        $checkTransporterDetails=DB::table('users')->where('id',$request->transporter_id)->first();
        $vehcleDetails=DB::table('vehicle_types')->where('id',$request->vehicle_type_id)->first();
        $driverUserDetails=DB::table('users')->where('id',$request->driver_id)->first();

        $this->sendSMSs($checkUserDetails->phone_number); 
        $this->sendSMSs($checkTransporterDetails->phone_number); 
        $this->sendSMSs($driverUserDetails->phone_number); 

         

        $bookingData['book_id']='ORD-'.$getJob->id;
        $bookingData['job_id']=$getJob->id;
        $bookingData['user_id']= $request->user_id;
        $bookingData['booked_on']= date('Y-m-d H:i:s'); 
        $bookingData['approved']= '1';
        $bookingData['transporter_name']=$checkTransporterDetails->name;
        $bookingData['date_of_service']=$newDate;
        $bookingData['time_of_service']=$request->schedule_time;
        $bookingData['vehicle_name']=$vehcleDetails->name;
        $bookingData['license_plate']=$request->license_plate;
        $bookingData['driver_id']=$request->driver_id; 
        $bookingData['quote_id']=$request_quotes->id; 
        $bookingData['mobile_number']=$request->receiver_number;
        $bookingData['pick_up_region_id']=$request->pick_up_region_id;
        $bookingData['pick_up_sub_region_id']=$request->pick_up_sub_region_id;
        $bookingData['pick_up_latitude']=$pickUpLat;
        $bookingData['pick_up_longitude']=$pickUpLong; 
        
        $createBoking=Booking::create($bookingData);

        $tracking_id =(dechex($createBoking->id).uniqid());

        $createBoking->update([
            'tracking_id' =>$tracking_id,
            'invoice_no' =>'invoice-'.date('Yms').$createBoking->id,

        ]);


        

        
       

        $verification_code = mt_rand(10000, 99999);      



        $destination_address  =  $request->destination_address;
        $destinationLong      =  $request->destination_lat;
        $destinationLat       =  $request->destination_long;

    

    $receiverValue['user_id']                   = $request->user_id;
    $receiverValue['job_id']                    = $getJob->id; 
    $receiverValue['driver_id']                 = $request->driver_id;
    $receiverValue['receivers_name']            = $request->receivers_name;
    $receiverValue['receiver_number']           = $request->receiver_number;
    $receiverValue['destination_region_id']     = $request->destination_region_id;
    $receiverValue['destination_sub_region_id'] = $request->destination_sub_region_id;                  
    $receiverValue['destination_address']       = $destination_address;                  
    $receiverValue['destination_lat']           = $destinationLong;
    $receiverValue['destination_long']          = $destinationLat;    
    $receiverValue['verification_code']         = $verification_code; 

    $message='رمز التحقق التسليم الخاص بك هو';
 


    JobReceiver::create($receiverValue);




    if ($request->same_receiver=='no') {

        if (count($request->receivers_name)) {

            $receiversValue=[];
            $verification_code =10002;
            foreach($request->receivers_name as $key => $valu) {

                // $verification_code =rand(9999,4);
                $message='رمز التحقق التسليم الخاص بك هو';                    

               // sendWhatsappMessage('+966',$request->receivers_number[$key],$message);

                $destinations_sub_region = SubRegion::where('id',$request->destinations_sub_region_id[$key])->first();

                $destinationLat  =  $destinations_sub_region['lat'];
                $destinationLong =  $destinations_sub_region['long']; 

                $destinationAddress ='';

                if (isset($request->receiver_address[$key])) {

                    $destinationAddress =$request->receiver_address[$key];
                    $destinationLat     =$request->receiver_lat[$key];
                    $destinationLong    =$request->receiver_long[$key];

                }

                $receiversValue['user_id']                   = $request->user_id;
                $receiversValue['job_id']                    = $getJob->id; 
                $receiversValue['receivers_name']            = $request->receivers_name[$key];
                $receiversValue['receiver_number']           = $request->receivers_number[$key];
                $receiversValue['destination_region_id']     = $request->destinations_region_id[$key];
                $receiversValue['destination_sub_region_id'] = $request->destinations_sub_region_id[$key];


                $receiversValue['destination_address']       = $destinationAddress;                  
                $receiversValue['destination_lat']           = $destinationLat;
                $receiversValue['destination_long']          = $destinationLong;  

                $receiversValue['verification_code']         = $verification_code; 

                JobReceiver::create($receiversValue);


                $verification_code = $verification_code+1;
            } 
        }
    }


    if ($getJob) {

        return $getJob->id;
         // return redirect()->route('jobs.index')->with('success','Job Added successfully');

              //return  view('web.user.job-success');
    }
}

public function jobUpdateManually(Request $request)
{
    //echo '<pre>';print_r($request->all()); die;
 

    $pickUpLat  = $request->pick_up_lat;
    $pickUpLong = $request->pick_up_long;

    $destinationLat  = $request->destination_lat;
    $destinationLong = $request->destination_long;

    $scheduleDate = str_replace('/', '-', $request->schedule_date);
    $newDate = date('Y-m-d', strtotime($scheduleDate));

    if($request->number_of_vehicle==1){
        $same_receiver='yes';
    }else{
        $same_receiver=$request->same_receiver;
    }

    
    $data['title']                 =  Product::where('id',$request->product_id)->first('name')->name;
    $data['vehicle_type_id']       =  $request->vehicle_type_id;
    // $data['number_of_vehicle']     =  $request->number_of_vehicle;
    $data['same_receiver']         =  $same_receiver;
    $data['schedule_date']         =  $newDate;
    $data['schedule_time']         =  $request->schedule_time;
    $data['total_goods_weight']    =  $request->total_goods_weight;
    $data['description_of_goods']  =  $request->description_of_goods;
    $data['number_of_items']       =  $request->number_of_items;
    $data['product_id']            =  $request->product_id;
    $data['pick_up_region_id']     =  $request->pick_up_region_id;
    $data['pick_up_sub_region_id'] =  $request->pick_up_sub_region_id;
    $data['pick_up_address']       =  $request->pick_up_address;
    $data['pick_up_lat']           =  $pickUpLat;
    $data['pick_up_long']          =  $pickUpLong; 
    $data['user_id']               =  $request->user_id;
    $data['transporter_id']        =  $request->transporter_id;
    $data['is_active_date']        =  Carbon::now()->addMinute(60);
    $data['rfq_status']            =  $request->rfq_status=='on'?'1':'0';
    $data['requirements']          =  $request->requirements;
    $data['other']                 =  @$request->other;
    $data['created_by']            =  'Admin';



   // if( $request->rfq_status=='on')
   // {

 

        $radius= Setting::first()->radius?(int)Setting::first()->radius:25;

        $data['rfq_status']            = '0';



        if ($newDate == date('Y-m-d')) {
           /* $data['is_active_date'] =  Carbon::now()->addMinute(15);
            $is_active_date =  Carbon::now()->addMinute(15); */

            $data['is_active_date'] =  sameDayTime();
            $is_active_date =  sameDayTime();

            
 

        }else{                
           /* $data['is_active_date'] =  Carbon::now()->addMinute(60);
            $is_active_date =  Carbon::now()->addMinute(60);*/

            $data['is_active_date'] =  isRFQTime();
            $is_active_date =  isRFQTime();

           
        }
        // echo '<pre>'; print_r($data); die;
        $getJob       = Job::where('id',$request->job_id)->update($data); 


        $checkUserDetails=DB::table('users')->where('id',$request->user_id)->first();
        $checkTransporterDetails=DB::table('users')->where('id',$request->transporter_id)->first();
        $vehcleDetails=DB::table('vehicle_types')->where('id',$request->vehicle_type_id)->first();

         

        
        $bookingData['user_id']= $request->user_id; 
        $bookingData['transporter_name']=$checkTransporterDetails->name;
        $bookingData['date_of_service']=$newDate;
        $bookingData['time_of_service']=$request->schedule_time;
        $bookingData['vehicle_name']=$vehcleDetails->name;
        $bookingData['license_plate']=$request->license_plate;
        $bookingData['driver_id']=$request->driver_id; 
        $bookingData['mobile_number']=$request->receiver_number;
        $bookingData['pick_up_region_id']=$request->pick_up_region_id;
        $bookingData['pick_up_sub_region_id']=$request->pick_up_sub_region_id;
        $bookingData['pick_up_latitude']=$pickUpLat;
        $bookingData['pick_up_longitude']=$pickUpLong; 
        
        $createBoking=Booking::where('id',$request->booking_id)->update($bookingData);


        
       

         $verification_code   = rand(9999,4);        
        //$verification_code   = 10001;
        // $message='رمز التحقق التسليم الخاص بك هو';
        // receiverVerificationCode('966' ,$request->receiver_number,$verification_code,$message);



        $destination_address  =  $request->destination_address;
        $destinationLong      =  $request->destination_lat;
        $destinationLat       =  $request->destination_long;

    

    $receiverValue['user_id']                   = $request->user_id;
    $receiverValue['driver_id']                 = $request->driver_id;
    $receiverValue['receivers_name']            = $request->receivers_name;
    $receiverValue['receiver_number']           = $request->receiver_number;
    $receiverValue['destination_region_id']     = $request->destination_region_id;
    $receiverValue['destination_sub_region_id'] = $request->destination_sub_region_id;                  
    $receiverValue['destination_address']       = $destination_address;                  
    $receiverValue['destination_lat']           = $destinationLong;
    $receiverValue['destination_long']          = $destinationLat;    
    $receiverValue['verification_code']         = $verification_code; 

    $message='رمز التحقق التسليم الخاص بك هو';

     



    JobReceiver::where('id',$request->job_receiver_id)->update($receiverValue);

 
    if ($request->same_receiver=='no') {

        if (count($request->receivers_name)) {

            $receiversValue=[];
            $verification_code =10002;
            foreach($request->receivers_name as $key => $valu) {

                // $verification_code =rand(9999,4);
                $message='رمز التحقق التسليم الخاص بك هو';                    

               // sendWhatsappMessage('+966',$request->receivers_number[$key],$message);

                $destinations_sub_region = SubRegion::where('id',$request->destinations_sub_region_id[$key])->first();

                $destinationLat  =  $destinations_sub_region['lat'];
                $destinationLong =  $destinations_sub_region['long']; 

                $destinationAddress ='';

                if (isset($request->receiver_address[$key])) {

                    $destinationAddress =$request->receiver_address[$key];
                    $destinationLat     =$request->receiver_lat[$key];
                    $destinationLong    =$request->receiver_long[$key];

                }

                $receiversValue['user_id']                   = $request->user_id;
                $receiversValue['receivers_name']            = $request->receivers_name[$key];
                $receiversValue['receiver_number']           = $request->receivers_number[$key];
                $receiversValue['destination_region_id']     = $request->destinations_region_id[$key];
                $receiversValue['destination_sub_region_id'] = $request->destinations_sub_region_id[$key];


                $receiversValue['destination_address']       = $destinationAddress;                  
                $receiversValue['destination_lat']           = $destinationLat;
                $receiversValue['destination_long']          = $destinationLong;  

                $receiversValue['verification_code']         = $verification_code; 

                JobReceiver::where('id',$request->job_receiver_id)->update($receiversValue);

                $verification_code = $verification_code+1;
            } 
        }
    }


    if ($request->job_id) {

        return $request->job_id;
         // return redirect()->route('jobs.index')->with('success','Job Added successfully');

              //return  view('web.user.job-success');
    }

}
public function manuallyPaymentFromAdmin(Request $request){

    $job_id=$_GET['job_id'];
    $amount=$_GET['amount'];
    $user_id=$_GET['user_id'];

    $book_id='ORD-'.$job_id;

    $checkOrder=Db::table('bookings')->where('book_id',$book_id)->first();  
    $checkUserEmail=Db::table('users')->where('id',$user_id)->first();


    $transaction['booking_id']=$checkOrder->id;
    $transaction['job_id']=$job_id;
    $transaction['user_id']=$user_id;
    $transaction['booked_on']=$checkOrder->booked_on;
    $transaction['amount']=$amount;
    $transaction['status']='Authorized';
    $transaction['approved']='1';
    $transaction['customer_email']=$checkUserEmail->email; 
    $transaction['created_at']=date('Y-m-d H:i:s');
    $transaction['updated_at']=date('Y-m-d H:i:s');

    $checkOrder=Db::table('transactions')->where('booking_id',$checkOrder->id)->where('job_id',$job_id)->where('user_id',$user_id)->first();
    if(!empty($checkOrder)){

        $saveTransaction=Db::table('transactions')->where('id',$checkOrder->id)->update($transaction);
    }else{
        $saveTransaction=Db::table('transactions')->insert($transaction);
    } 


    return true;
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $job=Job::with('receiveQuotes','product','PickupRegion','PickupSubRegion','JobReceivers','JobReceiver')->where('id',$id)->first();

       if($job){
           $vehicle_Type= VehicleType::whereIn('id',explode(',',$job->vehicle_type_id))->get();
       }else{
        $vehicle_Type=[];
    }


    return view('jobs.view',compact('job','vehicle_Type'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Job::where('id',$id)->delete();
        Booking::where('job_id',$id)->update(['status'=>'cancelled','cancelled_by'=>'admin','cancel_at'=>now()]);
        ReceiveQuotes::where('job_id',$id)->update(['status'=>'cancelled','cancel_at'=>now()]);

        return response()->json([
            'message'=>'Delete successfully',
            'success'=>1,

        ]);

    }

    public function cancel(Request $request)
    {    $id=$_GET['id']; 
        Job::where('id',$id)->update(['status'=>'cancelled','cancelled_by'=>'admin','cancel_at'=>now()]);
        Booking::where('job_id',$id)->update(['status'=>'cancelled','cancelled_by'=>'admin','cancel_at'=>now()]);
        ReceiveQuotes::where('job_id',$id)->update(['status'=>'cancelled','cancel_at'=>now()]);

        
        return response()->json([
            'message'=>'Job cancelled successfully',
            'success'=>1,

        ]);

    }

    public function viewRecieverDetail($id){
        $job_receiver_details  =  JobReceiver::with('DestinationRegion','DestinationSubRegion')->where('id',$id)->first();

       // $job_receiver_details  =Job::with('receiveQuotes','product','PickupRegion','PickupSubRegion','JobReceiver')->where('id',$id)->first();

        return response()->json([
            'data'=>$job_receiver_details,
        ]);
    }
    public function viewRecievedQuotationDetail($id){
        $job_receive_quote_details  =  ReceiveQuotes::with('user','driver')->where('id',$id)->first();
        return response()->json([
            'data'=>$job_receive_quote_details,
        ]);
    }



    public function filetrJob(Request $request){

        $jobs   =  Job::with('product','PickupRegion','PickupSubRegion','JobReceiver')->Filetr($request)->orderBy('status','ASC')->get();


        $result_view = view('jobs.partial',['jobs'=>$jobs])->render();
        return json_encode(['html'=> $result_view,'status'=>true]);
    }

    public function resetJob(Request $request){
        $page   =   $request->current;
        $limit  =   $request->limit;
        $offset =   ($limit * $page) -  $limit;
        if($request->id){
            $job_ids    =   ReceiveQuotes::where('driver_id',$request->id)->pluck('job_id');
            $jobs       =   Job::with('product','PickupRegion','PickupSubRegion','JobReceiver')->whereIn('id',$job_ids)->orderBy('schedule_date')->get();
        }else{
            $jobs   =  Job::with('product','PickupRegion','PickupSubRegion','JobReceiver')->orderBy('schedule_date')->skip($offset)->take($limit)->get();
        }

        $result_view = view('jobs.partial',['jobs'=>$jobs])->render();
        return json_encode(['html'=> $result_view,'status'=>true]);

    }
    public function exportJob(Request $request){
        $search     =        $request->search?$request->search:null;
        $date       =        $request->date_range?explode('-',$request->date_range):null;
        $status     =      $request->job_status?$request->job_status:null;

 

 
        return Excel::download(new JobExport($search,$date,$status), 'jobs.xlsx');
    }
    public function csvJob(Request $request){
        $search     =        $request->search?$request->search:null;
        $date       =        $request->date_range?explode('-',$request->date_range):null;
         $status     =      $request->job_status?$request->job_status:null;
        return (new JobExport($search,$date,$status))->download('jobs.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
    }

    public function pdfJob(Request $request){
        $search     =        $request->search?$request->search:null;
        $date       =        $request->date_range?explode('-',$request->date_range):null;

        $jobs=new Job;
        if(!empty($date)){
            $jobs = $jobs->where('created_at','>=',date('Y-m-d',strtotime($date[0])))->where('created_at','<=',date('Y-m-d',strtotime($date[1])));
        }
       /* if(!empty($search)){
            $jobs= $jobs->where(function($q) use($search){
                $q->orWhere('created_at','like', '%' . $search.'%');
                $q->orWhere('title','like', '%' . $search.'%');
                $q->orWhere('schedule_date','like', '%' . $search.'%');
                $q->orWhere('schedule_time','like', '%' . $search.'%');
                $q->orWhere('number_of_vehicle','like', '%' . $search.'%');

            });
        }*/
         if (!empty($status)) {
            $jobs->where('status',$status);
        }

        $jobs=$jobs->with('product','PickupRegion','PickupSubRegion','JobReceiver')->orderBy('schedule_date')->get();
        $data = [
         'jobs'=>$jobs,
     ];
     $pdf        = PDF::loadView('pdf.job', $data);
     return $pdf->download('jobs.pdf');

 }

 public function updateActiveDate(Request $request)
 {
    $datetime =date('Y-m-d,H:i:s',strtotime(str_replace('/','-',$request->datetime)));

    ReceiveQuotes::where('id',$request->id)->update(['is_active_date'=>$datetime]);

    return $datetime;  
}


function sendSMSs($phone_number){
    try{  
        
$message_body ="
تم ارسال طلب حمولة والتفاصيل في حسابك في عربات

New job received. Details are in your account in Arabat.

نئی نوکری مل گئی۔ تفصیلات عربات میں آپ کے اکاؤنٹ میں موجود ہیں۔

عربات";

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
    
        \Log::info([
            'job_create_otp' => $data
        ]);
    
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
    
        \Log::info([
            'user_resend_otp_res_ok--' => $response
        ]);
    
    
    }catch(\Exception $e){
        \Log::info([
            'error occured in sending sms for forget pass' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile()
        ]);
    }
    }



   

}
