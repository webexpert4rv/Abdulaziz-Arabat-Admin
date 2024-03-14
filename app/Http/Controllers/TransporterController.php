<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Config;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\helpers;
use App\Models\TransporterDetail;
use Storage;
use DB;
use App\Models\ReceiveQuotes;
use App\Models\RequestQuotes;
use App\Models\MoreDocument;
use App\Models\ReferrerWallet;
use App\Models\Transaction;
use App\Models\SaveCard;
use App\Models\Notification;
use App\Models\Booking;
use App\Models\TransporterWallet;
use App\Models\DriverWallet;
use App\Models\Pricing;
use App\Models\Job;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\InsuranceType;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Hash;
class TransporterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /*public function index(Request $request)
    { 
        $transporters = User::with('transporterDetails')->where('role_id',Config::get('variables.Transporter'))->orderBy('id','DESC')->get();

        return view('transporter.index',compact('transporters'));
    }*/


    public function index(Request $request)
    {

         
        if ($request->ajax()) { 
            $data =User:: with('transporterDetails')->where('role_id',Config::get('variables.Transporter'))->orderBy('id','DESC');
            
            if (!empty($request->date_range[0])) {
                $date_range = $request->date_range; 
                $data->whereDate('created_at','>=',date('Y-m-d',strtotime($date_range[0])))
                ->whereDate('created_at','<=',date('Y-m-d',strtotime($date_range[1])));
            }
            $getData=$data->get();
            return Datatables::of($getData)
            ->addIndexColumn()
            ->addColumn('account_type', function($row){
                $btn =  $row->account_type==1? 'User Business':$row->account_type==0?'User Personal':'' ;
                return $btn;
            })
            ->addColumn('created_at', function($row){
                $btn =  date('d/m/Y',strtotime($row->created_at)) ;
                return $btn;
            }) ->addColumn('status', function($row){
                $checked = $row->status==1?'checked':'';
                $status = $row->status==1?'0':'1';
                if(auth()->user()->can('edit_transporter'))
                {
                    $btn = '<label class="switch">
                    <input type="checkbox"  '.$checked.'  id="demo'.$row->id.'" onchange="updateStatus('.$row->id.','.$status.')" /  >
                    <span class="slider round"></span>
                    </label>' ;
                    return $btn;
                }
            })
            ->addColumn('is_approve', function($row){
                $checked = $row->status==1?'checked':'';
                $status = $row->status==1?'0':'1';
                if(auth()->user()->can('edit_transporter'))
                {

                    $btes ='<div class="approve_css approve_status'.$row->id.'">
                            <div class="loader_cssforgot_loader_img'.$row->id.'">';

                    if($row->is_approve==0){

                         

                      $btn =   '<a class="action-button btn btn-danger" onclick="transporterApproveStatus('.$row->id.',1)" href="javascript:void(0)">Pending</a>';
                  }else{
                     $btn =    '<a class="action-button btn btn-success"  onclick="transporterUnApproveStatus('.$row->id.',0)"  href="javascript:void(0)">Approved</a>';
                 }
                 $btess ='</div></div>';
                 return $btes. $btn .$btess;

             }
         })
            ->addColumn('action', function($row){

                $btn1=$btn2=$btn3='';
                if(auth()->user()->can('view_transporter'))
                {
                    $btn1=  '<a class="action-button" title="View" href='.route('transporters.show',$row->id).'><i class="text-info fa fa-eye"></i></a>';
                }
                if(auth()->user()->can('edit_transporter'))
                {
                    $btn2=  '<a class="action-button" title="Edit" href='.route('transporters.edit',$row->id).'><i class="text-warning fa fa-edit"></i></a>';
                }
                if(auth()->user()->can('delete_transporter'))
                {
                    $btn3=  '<a class="action-button delete-button "   id="'.$row->id.'"  onclick="transporterDelete('.$row->id.')" title="Delete" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>';
                }
                return $btn1.$btn2.$btn3;
            })
            ->rawColumns(['status','is_approve','created_at','account_type', 'action'])
            ->make(true);
        }

        return view('transporter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transporter.create');
    }

    public function add(Request $request)
{    
    $unique_id = IdGenerator::generate([
                'table' => 'users',
                'field'=>'unique_ID', 
                'length' =>12, 
                'prefix'=>'TRANS-'
            ]);
    $referrere_id=NULL;
    if(!empty($request->referrer_code)){
        $referrere = User::where('referrer_code',$request->referrer_code)->first();
        if(!empty($referrere)){
            $referrere_id=$referrere->id;
        }else{
            $referrere_id=NULL;
        }
        
    }

    // $data['unique_ID']=$unique_id;
    // $data['profile_image']='storage/user_profile.jpg';
    // $data['role_id']=Config::get('variables.Transporter');
    // $data['name']=$request->full_name;
    // $data['email']=$request->email;
    // $data['company_name']=$request->company_name;
    // $data['phone_number']=$request->phone_number;
    // $data['city']=$request->city;
    // $data['country_code']='+966';
    // $data['ip_address']=$_SERVER['REMOTE_ADDR'];
    // $data['password']=Hash::make(mt_rand(100000,999999));
    // $data['referrer_id']=$referrere_id;
    // $data['login_with']='email'; 
    // $data['account_type']=2;
    // $data['created_by']='admin';
    // $data['is_approve']=1;
    // $data['is_email_verified']='1';
    // $data['email_verified_at']=date('Y-m-d H:i:s');
    // $data['created_at']=date('Y-m-d H:i:s');
    // $data['updated_at']=date('Y-m-d H:i:s');
    
     

   $user = User::create([
            'role_id' => 2,
            'unique_ID' =>$unique_id,
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make(mt_rand(100000,999999)),
            'ip_address' => $_SERVER['REMOTE_ADDR'], 
            'country_code'=>'+966',           
            'phone_number' =>$request->phone_number,
            'login_with' => 'email',
            'signup_via' => 'mobile',
            'profile_image' => 'storage/user_profile.jpg',           
            'account_type' =>'2',
            'created_by' =>'Admin',
            'referrer_id'   => $referrere_id,
            'commission'=>$request->commission,
            'is_email_verified'=>'1',
            'email_verified_at'=>date('Y-m-d H:i:s'),
             


        ]); 

    // $data1['description']                   =     $request->description;

   $data1['public_transport_authority_license']=NULL;
   $data1['commercial_registration']=NULL;
   $data1['vat_registration']=NULL;
   $data1['iban_details']=NULL;

    if ($request->hasFile('public_transport_authority_license')) {

       $image            = Storage::disk('public')->putFile('public_transport_authority_license',$request->public_transport_authority_license);
       $data1['public_transport_authority_license']  ='storage/'.$image;
   }   

   if ($request->hasFile('commercial_registration')) {
       $image            = Storage::disk('public')->putFile('commercial_registration',$request->commercial_registration);
       $data1['commercial_registration']  ='storage/'.$image;
   }   
   if ($request->hasFile('vat_registration')) {
       $image            = Storage::disk('public')->putFile('vat_registration',$request->vat_registration);
       $data1['vat_registration']  ='storage/'.$image;
   }  
   if ($request->hasFile('iban_details')) {
       $image            = Storage::disk('public')->putFile('iban_details',$request->iban_details);
       $data1['iban_details']  ='storage/'.$image;
   }  
   if ($request->hasFile('verification_image')) {
       $image            = Storage::disk('public')->putFile('VerificationImage',$request->verification_image);
       $data1['verification_image']  ='storage/'.$image;
   }  

        TransporterDetail::create([ 
           'transporter_id'=>$user->id, 
           'vehicle_owner_name'=>$request->name,
           'public_transport_authority_license'=>$data1['public_transport_authority_license'],
           'pta_license_number'=> $request->pta_license_number,
           'commercial_registration'=>$data1['commercial_registration'],
           'vat_registration'=>$data1['vat_registration'],
           'iban_details'=>$data1['iban_details'],
           'name_transporter_supervisor'=>$request->transporter_supervisor_name,
           'country_code'=>$request->country_code,
           'supervisor_phone_number'=>$request->mobile, 

       ]); 

    
    return redirect()->route('transporters.index')->with('success','Transporter Added successfully');
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        User::create($data);
        return redirect()->back()->with('success','Create successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transporter        = User::with('transporterDetails')->where(['role_id'=>Config::get('variables.Transporter'),'id'=>$id])->first();
        $driver             = User::with('transporterDetails')->where(['role_id'=>Config::get('variables.Driver'),'parent_id'=>$id])->get();
        $more_documents     =   MoreDocument::where('user_id', $transporter->id)->get();


        $getnotification=Notification::where('receiver_id',$id)->orderBy('id','DESC')->paginate(10);     




        $getDriver             =   User::where('parent_id',$id)->get(); 
        $getOnlineDriver       =   User::where('parent_id',$id)->where('is_online','1')->get(); 
        $driverID              =   DB::table('users')->where('parent_id',$id)->pluck('id'); 
        $quote_amount          =   Booking::whereIn('driver_id',$driverID)->where('status','service_completed')->sum('quote_amount');
        $totalReceivedAmount   =   TransporterWallet::where('transporter_id',$id)->sum('amount');
        $commission            =   TransporterWallet::where('transporter_id',$id)->sum('admin_commission');
        $paid_amount           =   DriverWallet::where('transporter_id',$id)->sum('amount');        
        $remaining_amount      =   $totalReceivedAmount-$paid_amount;    
        $panelty_amount        =   DriverWallet::where('driver_id',$id)->sum('penalty_amount');


        $getPricing=Pricing::first();
        $tax =$getPricing->tax;
        $transporteCommission =$getPricing->commission;


        $commission=($quote_amount*$transporteCommission/100)*(1+$tax/100);

        // $checkUserCommission = User::select('commission')->where('id',auth()->user()->id)->first();

        // if(!empty($checkUserCommission)){
        //     $userCommission =$checkUserCommission->commission;

        //     if($userCommission!='' && $userCommission!=null){
                
        //         $commission=($quote_amount*$userCommission/100)*(1+$tax/100);

        //     }
        // }

        $totalEarning=$quote_amount-$commission;


        // echo '<pre>'; print_r($driverID); die;
        $jobs = Job::whereHas('booking',function ($q) use($driverID){
           $q->whereIn('driver_id',$driverID);  

       })
        ->with('product','PickupRegion','PickupSubRegion','JobReceiver')->orderBy('id','DESC')->orderBy('status','ASC')->get();

        $todayDateTime = date('Y-m-d H:i:s');
        $receive_quations = Job::where('status','pending')->where('is_active_date','>=',$todayDateTime)  
        ->with('product','PickupRegion','PickupSubRegion','JobReceiver')->orderBy('id','DESC')->orderBy('status','ASC')->get();

        // echo '<pre>'; print_r($receive_quations); die;

        return view('transporter.view',compact('transporter','driver','more_documents','getnotification','getDriver','totalEarning','totalReceivedAmount','commission','paid_amount','remaining_amount','panelty_amount','jobs','receive_quations','getOnlineDriver'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $transporter = User::with('transporterDetails')->where(['role_id'=>Config::get('variables.Transporter'),'id'=>$id])->first();
        return view('transporter.edit',compact('transporter'));
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
     $user=User::find($id);
     $data['name']              =     $request->name;
     $data['role_id']           =     Config::get('variables.Transporter');
     $data['email']             =     $request->email;
     $data['phone_number']      =     $request->phone_number;
     $data['country_code']      =     str_replace(str_replace(' ', '', $request->phone_number), '', $request->full); 
     $data['password']          =     $request->password!=null?bcrypt($request->password):$user->password;
     $data['token_type']        =     'web';
     $data['created_by']        =     'self';
     $data['account_type']      =      2;
     $data['commission']        =     $request->commission;
     $data['lat']               =     $request->lat;
     $data['long']              =     $request->long;
     $data['address']           =     $request->address;
     $data['city']              =     $request->city;
     $data['zip_code']          =     $request->zip_code;
     $data['is_push_notifications']          =     $request->is_push_notifications;
     $data['is_email_notifications']          =     $request->is_email_notifications;


     if ($request->hasFile('profile_image')) {
        $image              = Storage::disk('public')->putFile('ProfileImage',$request->profile_image);
        $data['profile_image']      ='storage/'.$image;
    }

    User::where('id',$id)->update($data);


    $data1['description']                   =     $request->description;

    if ($request->hasFile('public_transport_authority_license')) {
       $image            = Storage::disk('public')->putFile('public_transport_authority_license',$request->public_transport_authority_license);
       $data1['public_transport_authority_license']  ='storage/'.$image;
   }   

   if ($request->hasFile('commercial_registration')) {
       $image            = Storage::disk('public')->putFile('commercial_registration',$request->commercial_registration);
       $data1['commercial_registration']  ='storage/'.$image;
   }   
   if ($request->hasFile('vat_registration')) {
       $image            = Storage::disk('public')->putFile('vat_registration',$request->vat_registration);
       $data1['vat_registration']  ='storage/'.$image;
   }  
   if ($request->hasFile('iban_details')) {
       $image            = Storage::disk('public')->putFile('iban_details',$request->iban_details);
       $data1['iban_details']  ='storage/'.$image;
   }  
   if ($request->hasFile('verification_image')) {
       $image            = Storage::disk('public')->putFile('VerificationImage',$request->verification_image);
       $data1['verification_image']  ='storage/'.$image;
   }  

   $transporterDetail=TransporterDetail::where('transporter_id',$id)->first();

   if($transporterDetail){
    TransporterDetail::where('transporter_id',$id)->update($data1);

}else{
  $data1['transporter_id']  = $id;
  TransporterDetail::create($data1);

}

return redirect()->route('transporters.index')->with('success','Updated successfully');

}
public function filterTransporter(Request $request){
    $date_range = $request->date_range;
    $page   =   $request->current;
    $limit  =   $request->limit;
    $offset =   ($limit * $page) -  $limit;
    if($request->type=='user'){
        $users  = User::where('role_id',Config::get('variables.Transporter'))->whereDate('created_at','>=',date('Y-m-d',strtotime($date_range[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($date_range[1])))->take($limit)->skip($offset)->get();
    }else{
        $users  = User::where('role_id',Config::get('variables.Transporter'))->whereDate('created_at','>=',date('Y-m-d',strtotime($date_range[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($date_range[1])))->take($limit)->skip($offset)->get();
    }
    $result_view = view('transporter.partial',['users'=>$users])->render();
    return json_encode(['html'=> $result_view,'status'=>true]);
}

public function resetTransporter(Request $request){


    $page   =   $request->current;
    $limit  =   $request->limit;
    $offset =   ($limit * $page) -  $limit;
    if($request->type=='user'){
        $users          =   User::where('role_id',Config::get('variables.Transporter'))->take($limit)->skip($offset)->get();
    }else{
        $users          =   User::where('role_id',Config::get('variables.Transporter'))->take($limit)->skip($offset)->get();
    }

    $result_view    =   view('transporter.partial',['users'=>$users])->render();
    return json_encode(['html'=> $result_view,'status'=>true]);

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::where('id',$id)->first();
      if($user) {
        $drivers = $user->drivers;
        $drivers->each(function ($driver) {
            $driver->delete();
        });
        $user->delete();
      }
      return response()->json([
        'message'=>'Delete successfully',
        'success'=>1,

    ]);
  }

public function transportApproveStatus(Request $request)
{
    $length = 16;
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = substr(str_shuffle(str_repeat($pool, 5)), 0, $length);

    $userUpdate =  User::where('id', $request->id)->update([
        'is_approve' => $request->status,
        'is_email_verified' => '1',
        'password' => bcrypt($password)
    ]);

    if ($userUpdate) {
        $user = User::where('id', $request->id)->first();
        $emailData['id'] = $user->unique_ID;
        $emailData['email'] = $user->email;
        $emailData['customer'] = $user->name;
        $emailData['password'] = $password;

        if ($user->language_code == 'ar') {
            $emailData['subject'] = 'حياكم الله في عربات';
            $view = 'emails.approve_transporter_ar';
        } elseif ($user->language_code == 'ur') {
            $emailData['subject'] = 'رجسٹریشن ایکٹیویشن';
            $view = 'emails.approve_transporter_ur';
        } else {
            $emailData['subject'] = 'Registration activation';
            $view = 'emails.approve_transporter';
        }

        // Send email
        sendMail($view, $emailData);

        // Construct SMS message
        $message_body_en = 'Dear ' . $user->name . ', We welcome you as a partner with Arabat.

        This SMS  serves as a confirmation that your account is activated and that you are officially a part of the Arabat family.';

       $message_body_ar = $user->name . ' عزيزي،' .
    "\n\n" .
    'السلام عليكم' .
    "\n\n" .
    'نرحب بكم كشريك معنا في عربات. هذا الرسالة بمثابة تأكيد على تنشيط حسابك كناقل وأنك رسميًا جزء من أسرة عربات.';



        // Combine English and Arabic messages
        $message_body = $message_body_en . "\n\n" . $message_body_ar;

        // Send SMS
        $this->sendSMS($user->phone_number, $message_body); 

        // Check if there's a referrer
        $greferrer = User::where('id', $user->id)->where('referrer_id', '!=', '')->first();
        if ($greferrer) {
            if (ReferrerWallet::where('user_id', $user->id)->doesntExist()) {
                $data = [
                    'user_id' => $user->id,
                    'earn' => 5,
                    'spend' => '',
                ];
                ReferrerWallet::create($data);

                if (ReferrerWallet::where('user_id', $greferrer->referrer_id)->doesntExist()) {
                    $data = [
                        'user_id' => $greferrer->referrer_id,
                        'earn' => 5,
                        'spend' => '',
                    ];
                    ReferrerWallet::create($data);
                } else {
                    ReferrerWallet::where('user_id', $greferrer->referrer_id)->increment('earn', 5);
                }
            }
        }

        return response()->json([
            'message' => 'Approved successfully',
            'success' => 1,
        ]);
    }

    return response()->json([
        'message' => 'User not found or update failed',
        'success' => 0,
    ]);
}

protected function sendSMS($phone_number, $message_body)
    {
        try {
            // Retrieve the language from the session
            $language_code = session()->get('language', 'en'); // Default to English if language is not set

            $complete_mobile_number = $phone_number;

            // Construct the message body based on the language
            $apiUrl = 'https://api.taqnyat.sa/v1/messages';
            $accessToken = '475b33120697346bd743efb7e311993f';

            $headers = [
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json',
            ];

            $data = [
                'recipients' => [$complete_mobile_number],
                'body' => $message_body,
                'sender' => 'Arabat.sa',
            ];

            \Log::info([
                'transporter_signup_data----' => $data
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
                'transporter_signup--' => $response
            ]);
        } catch (\Exception $e) {
            \Log::info([
                'error occured in sending sms for forget pass' => $e->getMessage() . ' on line no ' . $e->getLine() . ' in file ' . $e->getFile()
            ]);
        }
    }


public function transportUnApproveStatus(Request $request){

    $userUpdate =  User::where('id',$request->id)->update([
        'is_approve'=>$request->status]);

    return response()->json([

        'message'=>'Un Approved successfully',
        'success'=>1,

    ]);

}
public function DriverShow($id){

    $vehicletypes       =VehicleType::all();
    $insurancetypes     =InsuranceType::all();
    // echo '<pre>'; print_r($insurancetypes); die;
    $driver= User::with('driverDetails','vehicleDetails','moreDocument')->where('id',$id)->first();
    $driverPassword=User::where('id',$id)->first()->password;
     

    $vehicletypeList='';
    $insuranceTypeList='';
    $vehicleRegistrationYearList='';
    if(!empty($driver['vehicleDetails']['vehicleType']['id'])){
       $vehicle_type_id = $driver['vehicleDetails']['vehicleType']['id'];
       foreach($vehicletypes as $vehicletype){

         if($vehicletype->id==$vehicle_type_id){$sel='selected';}else{$sel='';}
        $vehicletypeList.='<option value="'.$vehicletype->id.'" '.$sel.'> '.$vehicletype->name.' ('.$vehicletype->max_load.' '.$vehicletype->max_load_unit.' , '.$vehicletype->length.' '.$vehicletype->unit.')</option>';

       }
    }

    if(!empty($driver['vehicleDetails']['insuranceType']['id'])){
       $insurence_type_id = $driver['vehicleDetails']['insuranceType']['id'];
       foreach($insurancetypes as $insurancetype){

         if($insurancetype->id==$insurence_type_id){$sel='selected';}else{$sel='';}
        $insuranceTypeList.='<option value="'.$insurancetype->id.'" '.$sel.'> '.$insurancetype->name.'</option>';

       }
    }

    if(!empty($driver['vehicleDetails']['vehicle_registration_year'])){
        $getYear=$driver['vehicleDetails']['vehicle_registration_year'];

        $this_year = date("Y"); // Run this only once
        for ($year = $this_year; $year >= $this_year - 100; $year--) {
            
        if($year==$getYear){$sel='selected';}else{$sel='';}
        $vehicleRegistrationYearList.='<option value="'.$year.'" '.$sel.'>'.$year.'</option>';
         
         }
    }
    
     
    $image=[];
    foreach ($driver->moreDocument as $key => $value) {

       $value->document;

       $image[]='<div class="col-sm-6">
       <div class="form-group form-wrapper">                       
       <img  class="pop1" width="50%" data-type="image" src="'.config('services.storage_image_path.web_path').'/'.$value->document.'">
       </div>                   
       </div>';             
   }
// echo '<pre>';print_r($driver); die;
   return response()->json([
    'data'=>$driver,
    'moreimage'=>$image,
    'moreimage'=>implode('', $image),
    'vehicleTypes'=>$vehicletypeList,
    'insuranceTypeList'=>$insuranceTypeList,
    'vehicleRegistrationYearList'=>$vehicleRegistrationYearList,
    'driverPassword'=>$driverPassword
]);

        //return view('transporter.driver_show',compact('driver'));
}

public function DriverAddDetails(Request $request){

    $vehicletypes       =VehicleType::all();
    $insurancetypes     =InsuranceType::all();
    // echo '<pre>'; print_r($insurancetypes); die;
   
     

    $vehicletypeList='';
    $insuranceTypeList='';
    $vehicleRegistrationYearList='';
    
    if(!empty($vehicletypes)){
        foreach($vehicletypes as $vehicletype){

              
            $vehicletypeList.='<option value="'.$vehicletype->id.'" > '.$vehicletype->name.' ('.$vehicletype->max_load.' '.$vehicletype->max_load_unit.' , '.$vehicletype->length.' '.$vehicletype->unit.')</option>';

           }
       }
    

    if(!empty($insurancetypes)){ 

       foreach($insurancetypes as $insurancetype){ 
        $insuranceTypeList.='<option value="'.$insurancetype->id.'" > '.$insurancetype->name.'</option>';

       }
    }

    
    $this_year = date("Y"); // Run this only once
    for ($year = $this_year; $year >= $this_year - 100; $year--) {
        $vehicleRegistrationYearList.='<option value="'.$year.'" >'.$year.'</option>';
     }
    
     
// echo '<pre>';print_r($driver); die;
   return response()->json([
    'vehicleTypes'=>$vehicletypeList,
    'insuranceTypeList'=>$insuranceTypeList,
    'vehicleRegistrationYearList'=>$vehicleRegistrationYearList
]);

        //return view('transporter.driver_show',compact('driver'));
}


public function DriverAdd(Request $request){

    // echo '<pre>'; print_r($request->all()); die;

    $getUserID = User::where('role_id',4)->orderBy('id','DESC')->pluck('unique_ID')->first();

    $prefix='DRIVER';$val=1;
     if (isset($getUserID)) {

        $UserID=  explode('-', $getUserID);
        $val = $UserID[1]+1;
        $prefix = $UserID[0];            
    }

    $unique_id=$prefix.'-'.str_pad($val,6,"0",STR_PAD_LEFT);

    $data['unique_ID']      = $unique_id;
    $data['name']           = $request->name;
    $data['phone_number']   = $request->phone_number; 
   $data['status']           = '0'; 
    $data['password']       = bcrypt($request->password);
    $data['parent_id']      = $request->transport_id;
    $data['is_phone_verified']='1';
    $data['account_type']   = '4';
    $data['role_id']        = Config::get('variables.Driver');

    // $data['country_code']   =       str_replace(str_replace(' ', '', $request->phone_number), '', $request->full);
    $data['country_code']   = "+966";
    // if ($request->hasFile('profile_image')) {
    //     $image              = Storage::disk('public')->putFile('ProfileImage',$request->profile_image);
    //     $data['profile_image']      ='storage/'.$image;
    // }

     
    $user=User::create($data);

    if($user){

        $data1['driver_id']     =   $user->id;
        $data1['transporter_id']=   $request->transport_id; 

        if ($request->hasFile('driver_licence')) {
            $image              = Storage::disk('public')->putFile('DriverLicence',$request->driver_licence);
            $data1['driver_licence']      ='storage/'.$image;
        }
        if ($request->hasFile('verification_id')) {
            $image              = Storage::disk('public')->putFile('VerificationId',$request->verification_id);
            $data1['verification_id']      ='storage/'.$image;
        }
        $transporter=TransporterDetail::create($data1);

        if($transporter){
        
          $insurance_expirydate = str_replace('/', '-', $request->insurance_expiry_date);
          $data2['driver_id']                  =  $user->id;
          $data2['transporter_id']             =  $request->transport_id;
          $data2['vehicle_type_id']            =  $request->vehicle_type_id;
          $data2['drivers_ID_or_iqama_number'] =  $request->drivers_ID_or_iqama_number;
          $data2['insurance_type_id']          =  $request->insurance_type_id;
          $data2['insurance_expiry_date']      =  date('Y-m-d',strtotime($insurance_expirydate));
          $data2['license_plate']              =  $request->license_plate;
          $data2['vehicle_registration_year']  =  $request->vehicle_registration_year;

        //  $data2['preferred_location_for_delivery']                  = implode(',',$request->preferred_location_for_delivery);
          if ($request->hasFile('insurance')) {
            $image              = Storage::disk('public')->putFile('insurance',$request->insurance);
            $data2['insurance']      ='storage/'.$image;
        }
        if ($request->hasFile('vehicle_registration')) {
            $image              = Storage::disk('public')->putFile('vehicle_registration',$request->vehicle_registration);
            $data2['vehicle_registration']      ='storage/'.$image;
        }
        if ($request->hasFile('Vehicle_PTA_License')) {
            $image              = Storage::disk('public')->putFile('Vehicle_PTA_License',$request->Vehicle_PTA_License);
            $data2['Vehicle_PTA_License']      ='storage/'.$image;
        }

        Vehicle::create($data2);

            return redirect()->back()->with('success','Driver Added successfully');
        
        }
    }


 
}


public function DriverUpdate(Request $request){

// echo '<pre>'; print_r($request->all()); die;
    $transporterId= User::where('id',$request->id)->first();
    $insurance_expiry_date = str_replace('/', '-', $request->insurance_expiry_date);
    $insurance_expiry_date = date('Y-m-d', strtotime($insurance_expiry_date));
     
    $updateDriverDetails = User::where('id',$request->id)->update(['name'=>$request->name]);
    $updateDriverVehicleDetails = Vehicle::where('driver_id',$request->id)->update(['vehicle_type_id'=>$request->vehicle_type_id,'insurance_type_id'=>$request->insurance_type_id,'insurance_expiry_date'=>$insurance_expiry_date,'license_plate'=>$request->vehicle_number,'vehicle_registration_year'=>$request->vehicle_registration_year]);
    $password = 'Demo@123';
    if(!empty($request->phone_number)){ 


            if (preg_match('/^[^ ].* .*[^ ]$/', $request->phone_number)) {

                $newMobile=substr($request->phone_number,4);
            }else{
                $newMobile=$request->phone_number;
            } 
              
            $countNumber =  User::where('id','!=',$request->id)->where('phone_number',$newMobile)->count();
             
            if($countNumber==0 || $countNumber==null){
                $getUserMobile = User::select('phone_number')->where('id',$request->id)->first();

                if(!empty($getUserMobile)){
                    $oldMobile=$getUserMobile->phone_number;

                    if($newMobile!=$oldMobile){

                        $data['phone_number']   = trim($newMobile);
                        $data['password']       = bcrypt($password);

                        $updateDriver= User::where('id',$request->id)->update($data);

                         
                    }
                }
                 
                
            } 
            
        }
        if(!empty($request->password)){

            $getPassword =  User::where('id',$request->id)->first();

            if($getPassword!=$request->password){

                $data['password']       = bcrypt($request->password);

                $updateDriverPassword= User::where('id',$request->id)->update($data);
            }

        }


        $getTransporter=TransporterDetail::where('driver_id',$request->id)->first();

        $data1['driver_licence']=$getTransporter->driver_licence;
        $data1['verification_id']=$getTransporter->verification_id;

        if ($request->hasFile('driver_licence')) {
            $image              = Storage::disk('public')->putFile('DriverLicence',$request->driver_licence);
            $data1['driver_licence']      ='storage/'.$image;
             
        }
        if ($request->hasFile('verification_id')) {
            $image              = Storage::disk('public')->putFile('VerificationId',$request->verification_id);
            $data1['verification_id']      ='storage/'.$image;
             
        }
        $transporter=TransporterDetail::where('driver_id',$request->id)->update($data1);
        

         

          $insurance_expirydate = str_replace('/', '-', $request->insurance_expiry_date);
 
          $data2['vehicle_type_id']            =  $request->vehicle_type_id; 
          $data2['insurance_type_id']          =  $request->insurance_type_id;
          $data2['insurance_expiry_date']      =  date('Y-m-d',strtotime($insurance_expirydate));
          $data2['license_plate']              =  $request->license_plate;
          $data2['vehicle_registration_year']  =  $request->vehicle_registration_year;

          $getVehicle=Vehicle::where('driver_id',$request->id)->first();

          $data2['insurance']=$getVehicle['insurance'];
          $data2['vehicle_registration']=$getVehicle['vehicle_registration'];
          $data2['Vehicle_PTA_License']=$getVehicle['Vehicle_PTA_License'];
        //  $data2['preferred_location_for_delivery']                  = implode(',',$request->preferred_location_for_delivery);
          if ($request->hasFile('insurance')) {
            $image              = Storage::disk('public')->putFile('insurance',$request->insurance);
            $data2['insurance']      ='storage/'.$image; 
        }
        if ($request->hasFile('vehicle_registration')) {
            $image              = Storage::disk('public')->putFile('vehicle_registration',$request->vehicle_registration);
            $data2['vehicle_registration']      ='storage/'.$image; 
        }
        if ($request->hasFile('Vehicle_PTA_License')) {
            $image              = Storage::disk('public')->putFile('Vehicle_PTA_License',$request->Vehicle_PTA_License);
            $data2['Vehicle_PTA_License']      ='storage/'.$image;
            
        }

        Vehicle::where('driver_id',$request->id)->update($data2);
         

    
        if($transporter){
            return redirect()->back()->with('success','Driver Updated successfully');
        }
        

}
public function DriverDelete($id){

    $driver=User::where('id',$id)->delete();

    if($driver){
        return 1;
    }else{
        return 0;
    }

}

public function checkPhoneNumber(Request $request){
   $user=User::where('phone_number',$request->phone_number)->withTrashed()->first();
   //dd($user);
   if(!empty($user)){
    return response()->json([
        'msg'=>0,
    ]);
    }else{
        return response()->json([
            'msg'=>1,
        ]);
    }
}


public function checkJobAccepted(Request $request){

    $getJobId = RequestQuotes::where('id',$request->id)->first()->job_id;
    $getJobStatus = DB::table('request_quotes')->select('users.name')
                    ->join('users','request_quotes.driver_id','=','users.id')
                    ->where('request_quotes.job_id',$getJobId)->where('request_quotes.status','accepted')->get();
    if(!empty($getJobStatus)){
        return response()->json([
        'data'=>$getJobStatus,
    ]);
    }else{
        return response()->json([
        'data'=>[],
    ]);
    }
     
}

public function forwardQuotation(Request $request){
        //dd($request->all());
    $validator = Validator::make($request->all(), [  

        'quote_id' => 'required|exists:request_quotes,id',             
        'driver_id' => 'required',             
    ]);
    
    if($validator->fails()) {
        $response = [
            'status' => 400,
            'message' => $validator->errors()->first()
        ];
        return response()->json($response); 
    }
    
    // $decline    =   RequestQuotes::where('id',$request->quote_id)->update(['driver_id'=>$request->driver_id]);
    $decline    =   RequestQuotes::where('id',$request->quote_id)->update(['status'=>'pending','driver_id'=>$request->driver_id]);
    $getJob     =  RequestQuotes::where('id',$request->quote_id)->first();

    $getJobDetails = Job::where('id',$getJob->job_id)->first();
    $newDate = $getJobDetails->schedule_date;
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

     $updateaActiveDate = Job::where('id',$getJob->job_id)->update(['is_active_date'=>$is_active_date]);
        // Notifica::create([
        //     'sender_id'         =>Auth()->user()->id, 
        //     'receiver_id'       =>$request->driver_id,  
        //     'action_id'         =>$request->quote_id,             
        //     'title'             =>"Posting of job/RFP", 
        //     'type'              =>'Job', 
        //     'isRead'            =>'0',
        //     'description'       =>"On successful posting of job/RFP",
        // ]); 
    if ($decline) {
        return response()->json([ 
            'status'    => 200,
            'message'   => 'Job forward  successfully',
            'data'      => [
                'forwardQuote' =>Null,                    
            ]
        ]);

    }else{

        return response()->json([ 
            'status'    => 400,
            'message'   => 'something wrong please try again',
            'data'      => Null
        ]);
    }
}



}
