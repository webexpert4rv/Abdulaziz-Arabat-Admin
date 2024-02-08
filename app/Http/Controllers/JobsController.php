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

        public function pendingPaymentApprove(Request $request){

            if(!empty($request->quote_id)){

                 $approvePaymentData = ReceiveQuotes::where('id',$request->quote_id)->first();
                 $getJob       = Job::where('id',$approvePaymentData->job_id)->first(); 
                 $approvePayment = ReceiveQuotes::where('id',$request->quote_id)->update(['approved_by_admin'=>'yes']);
                //below code is to bypass the payment.
                // $approvePayment = ReceiveQuotes::where('id',$request->quote_id)->update(['approved_by_admin'=>'yes', 'status'=>'accepted']);
                $quoteCount = 1;
                $driver_merge = [$approvePaymentData->user_id, $approvePaymentData->driver_id];
                $drivers = User::whereIN('id',$driver_merge)->get();

                if (count($drivers)) {

                    foreach ($drivers as $key => $value) {

                $getdrivers = User::where('id',$value->id)->where('is_push_notifications','1')->first(); 

                if (isset($getdrivers->fcmTokens)) {

                    foreach($getdrivers->fcmTokens as $key=> $tokenValue){


                        Notifica::create([
                            'sender_id'     =>Auth()->user()->id, 
                            'receiver_id'   => $getdrivers->id, 
                            'action_id'     =>  $getJob->id,               
                            'title'         =>"Payment Request", 
                            'type'          =>'Payment', 
                            'isRead'        =>'0',
                            'description'   =>"Payment Request Received",
                            'title_arabic'  =>"طلب وظيفة", 
                            'description_arabic'   =>"تم استلام طلب عمل جديد",
                        ]); 
    
                        // \Log::info([
                        //     'send--------------' => $getdrivers,
                        //     '$getJob->id' => $getJob->id,
                        //     '$getdrivers->account_type' => $getdrivers->account_type
                        // ]);



                        if($tokenValue->token_type==='ios'){
                            $data=[
                                'title'        => 'Payment Approved Sucessfully.', 
                                'body'         => 'Payment Approved Sucessfully.',             
                                'html'         => 'HTML',
                                'id'           =>  $getJob->id,
                                'type'         =>  1,
                                'account_type' =>  $getdrivers->account_type,
                                'service_type' => 'test_data',
                                'quote_count'   => $quoteCount,
                            ];

                        }else{
                            Notification::send($getdrivers, new \App\Notifications\User\PaymentRequestReceived($getJob->id,$quoteCount,$getdrivers->account_type)); 
                        }
                    } 
                }
            }
        }
                if($approvePayment){
                    return 1;
                }else{
                    return 2;
                }

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
            // echo $request->job_id;
            $user = Job::where('id',$request->job_id)->first();

            $getDriverList = User::whereIn('parent_id',$request->transporter_id)->pluck('id');
            // echo '<pre>';print_r($getDriverList); die;
            $getDriversRecord = RequestQuotes::where('job_id',$request->job_id)->whereIn('driver_id',$getDriverList)->delete();
             
            if(!empty($getDriverList)){
 
            foreach($getDriverList as $getDrivers){
            $addDrivers = RequestQuotes::create([
                        'user_id'         =>$user->user_id,
                        'job_id'         =>$request->job_id, 
                        'driver_id'       =>$getDrivers,
                        'is_active_date'  => $user->is_active_date,
                        'admin_assignjob_to_transporter'=>'1',
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
        $getUsers=User::select('*')->where('role_id',Config::get('variables.User'))->where('status','1')->get();
        $getTransporters=User::select('*')->where('role_id',Config::get('variables.Transporter'))->where('status','1')->get();
        $getTransporters=User::select('*')->where('role_id',Config::get('variables.Transporter'))->where('status','1')->get();

        return view('jobs.create3',compact('getJobData','getBookingData','getJobReceiverData','getUserData','getDriverData','getVehicleType','getProduct','getRegion','getUsers','getTransporters'));
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

            $subRegione=\Session::get('language')=="ar"?$value->arabic_name:Auth()->user()->language_code=="ur"?$value->arabic_name:$value->name;



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


        

        
       

        // $verification_code   = rand(9999,4);        
    $verification_code   = 10001;
        //$message='رمز التحقق التسليم الخاص بك هو';
        // receiverVerificationCode('966' ,$request->receiver_number,$verification_code,$message);



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


        
       

        // $verification_code   = rand(9999,4);        
    $verification_code   = 10001;
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

    // $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'https://api.twilio.com/2010-04-01/Accounts/AC663f1295d524f6c9254420d1f0b4f96f/Messages.json');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     'Content-Type: application/x-www-form-urlencoded',
// ]);
// curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
// curl_setopt($ch, CURLOPT_USERPWD, 'AC663f1295d524f6c9254420d1f0b4f96f:250794cc5fbe94654319a744fe27a3f2');
// curl_setopt($ch, CURLOPT_POSTFIELDS, 'To=whatsapp%3A%2B918146407156&From=whatsapp%3A%2B14155238886&Body=Your+appointment+is+coming+up+on+July+21+at+3PM');

// $response = curl_exec($ch);
// echo '<pre>'; print_r($response); die;
// curl_close($ch);
       sendWhatsappMessage('+966',$request->receiver_number,$message);
        receiverVerificationCode('+966',$request->receiver_number,$verification_code,$message);



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



}
