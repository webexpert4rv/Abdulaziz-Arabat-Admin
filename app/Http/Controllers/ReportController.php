<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransporterWallet;
use Config;
use PDF;
use MPDF;
use DB;
use Carbon\Carbon;  
use App\Exports\ExportUserQuations;
use App\Exports\ExportTransporterQuations;
use App\Exports\ExportUserInvoice;
use Maatwebsite\Excel\Facades\Excel; 
use App\Models\Booking;
use App\Models\JobReceiver;
use App\Models\ReceiveQuotes;
use App\Models\Pricing;
use App\Models\JobsPaymentDetails;


class ReportController extends Controller
{
    //
    public function index(Request $request){
        
        $totalUsers         =   User::where('role_id',3)->count();
        $totalLoginUsers    =   User::where('role_id',3)->where('login_status','1')->count();
        $totalTransaction   =   Transaction::count();
        $totalSale	        =	Transaction::count();
      

        $totalUsersCurrentYear =  User::select('*')
                        ->where('role_id',3)
                        ->whereYear('created_at', date('Y'))
                        ->count();
        $totalLoginUsersCurrentYear =  User::select('*')
                        ->where('role_id',3)
                        ->where('login_status','1')
                        ->whereYear('created_at', date('Y'))
                        ->count();
        
        $totalTransactionCurrentYear   =   Transaction::whereYear('created_at', date('Y'))->count();
        $totalSaleCurrentYear	        =	Transaction::whereYear('created_at', date('Y'))->count();

        if($request->ajax()){
        
            $totalUsersCurrentYear =  User::select('*')
            ->where('role_id',3)
            ->reportFilter($request)
            ->count();
            $totalLoginUsersCurrentYear =  User::select('*')
                        ->where('role_id',3)
                        ->where('login_status','1')
                        ->reportFilter($request)
                        ->count();

            $totalTransactionCurrentYear   =   Transaction::reportFilter($request)->count();
            $totalSaleCurrentYear	       =	Transaction::reportFilter($request)->count();
          
            return response()->json([
                    'totalUsersCurrentYear'=>$totalUsersCurrentYear,
                    'totalLoginUsersCurrentYear'=>$totalLoginUsersCurrentYear,
                    'totalTransactionCurrentYear'=>$totalTransactionCurrentYear,
                    'totalSaleCurrentYear'=>$totalSaleCurrentYear,
            ]);

        }
        return view('reports.index',compact('totalUsersCurrentYear','totalLoginUsersCurrentYear','totalSaleCurrentYear','totalTransactionCurrentYear','totalSale','totalLoginUsers','totalUsers','totalTransaction'));
    }

    public function downloadQuationInvoice(Request $request){

        $getUsers=User::select('*')->where('role_id',Config::get('variables.User'))->where('status','1')->get();
        $getTransporters=User::select('*')->where('role_id',Config::get('variables.Transporter'))->where('status','1')->get();

        return view('reports.download_quation_ivoice',compact('getUsers','getTransporters'));
    }

    public function downloadUserQuationInvoice(Request $request){

            $userId     =        $request->user_id;
            $userType   =        $request->type;
            
            switch ($request->input('action')) { 

                case 'userQuations':
                    return Excel::download(new ExportUserQuations($userId,$userType), 'User_Quations.xlsx');
                    break;

                    case 'userInvoice':
                    // return PDF::download(new ExportUserInvoice($userId,$userType), 'User_Invoice.xlsx');
                    $getBookings =Booking::where('user_id',$userId)->where('payment_status','success')->where('status','service_completed')->with('user','driver','job')->get();
        
                        $data=[];
                        foreach($getBookings as $getBooking){                             
                            $jobReceivers =JobReceiver::with('DestinationAddres')->where('job_id',$getBooking->job_id)->get();

                            $pricing    =   Pricing::first();
                            
                            // $commission=(($getBooking->quote_amount*$pricing->online_payment_discount)/100)*(1+$pricing->tax/100); 

                            // $checkUserCommission = User::select('commission')->where('id',$getBooking->user_id)->first();

                            // if(!empty($checkUserCommission)){
                            //     $userCommission =$checkUserCommission->commission;

                            //     if($userCommission!='' && $userCommission!=null){
                                    
                            //         $commission=(($getBooking->quote_amount*$userCommission)/100)*(1+$pricing->tax/100);

                            //     }
                            // }


                            $commission=(($getBooking->quote_amount*$pricing->online_payment_discount)/100); 

                            $tax = $pricing->tax;

                                $checkUserCommission = User::select('commission')->where('id',$getBooking->user_id)->first();

                                if(!empty($checkUserCommission)){
                                    $userCommission =$checkUserCommission->commission;

                                    if($userCommission!='' && $userCommission!=null){
                                        
                                        //$commission=(($getBooking->quote_amount*$userCommission)/100)*(1+$pricing->tax/100); //code commented by govind 20-jun 2024
                                        $commission=(($getBooking->quote_amount*$userCommission)/100);
                                    //  $tax = $userCommission;
                                    } 
                                }


                            $total_amount_tax = $commission;           

                            // $total_amount_without_tax =$total_amount_tax/(1+($tax/100)); //code commented by govind 20-jun 2024
                            $total_amount_without_tax =($total_amount_tax*$tax)/100;
                
                            //$tax_price = round($total_amount_tax-$total_amount_without_tax,2); //code commented by govind 20-jun 2024
                            $tax_price =$total_amount_without_tax;
 
                            if($getBooking->job->product->name=='Other') {

                                $title=$getBooking->job->other;                    
                    
                            }else{
                                $title=$request->type == 2?$getBooking->job->product->arabic_name:$getBooking->job->product->name;
                    
                            }                

                            $data[]=[
                                'book_id'      =>$getBooking->book_id,
                                'booked_on'    =>$getBooking->booked_on,
                                'invoice_no'   =>$getBooking->invoice_no,
                                'booking_status' =>$getBooking->status,
                                    //'invoice_no'   => 'invoice-'.date('Yms').$getBooking->id,
                                'user'=>[
                                    'name'                =>@$getBooking->user->name,
                                    'email'               =>@$getBooking->user->email, 
                                    'phone_number'        =>@$getBooking->user->country_code.@$getBooking->user->phone_number,
                                    'city'                =>@$getBooking->user->city, 
                                ],

                                'transporter'=>[
                                    "name"=>@$getBooking->driver->transporter->name,
                                    "pta_license_number"=>@$getBooking->driver->transporter->transporterDetails->pta_license_number,

                                ],

                                'driver'=>[
                                    'name'                =>@$getBooking->driver->name,
                                    'email'               =>@$getBooking->driver->email,
                                    'email'               =>@$getBooking->driver->email,
                                    'phone_number'        =>@$getBooking->driver->country_code.@$getBooking->driver->phone_number,
                                    'city'                =>@$getBooking->driver->city,
                                ], 
                                'job'=>[
                                    'title'               =>@$title, 
                                    'job_id'              =>@$getBooking->job->job_ID,
                                    'schedule_date'       =>@$getBooking->job->schedule_date,
                                    'schedule_time'       =>@$getBooking->job->schedule_time,
                                    'vehicle_type'        =>@$getBooking->vehicle_name,
                                    'pick_up_address'     =>@$getBooking->job->pick_up_address,
                                    'city'                =>@$getBooking->pickupSubRegion->name,
                                    'total_goods_weight'  =>@$getBooking->job->total_goods_weight,
                                    'description_of_goods'=>@$getBooking->job->description_of_goods,
                                    'number_of_items'     =>@$getBooking->job->number_of_items, 
                                    'sub_amount'          =>@$getBooking->quote_amount,
                                    'status'              =>@$getBooking->job->status,
                                ],

                                'tota'=>[
                                    'sub_amount'            =>@$getBooking->quote_amount,
                                    'discount'              =>@$getBooking->discount,
                                    'tax_price'             =>@$tax_price,
                                    'booking_fee'           =>@$getBooking->booking_fee,
                                    'commssion'             =>@$commission,
                                    'penaltiy_amount'       =>@$getBooking->penaltiy_amount,
                                ],
                                'jobReceivers' =>$jobReceivers
                            ];
                            }
                        
                        $pdf = PDF::loadView('reports.invoice', compact('data'));
                        
                        return $pdf->download('User_Invoices.pdf');
                      
                       // return view('reports.invoice',compact('data'));
                    break;

            } 
    }


    public function downloadTransporterQuationInvoice(Request $request){

                $userId     =        $request->transporter_id;
                $userType   =        $request->type;


                switch ($request->input('action')) { 

                    case 'transporterQuations':
                        return Excel::download(new ExportTransporterQuations($userId,$userType), 'Transporter_Quations.xlsx');
                        break;

                    case 'transporterInvoice':
                        // return Excel::download(new ExportUserQuations($userId,$userType), 'User_Quations.xlsx');

                    
                    
                    $driver      =   User::where('parent_id',$userId)->pluck('id');
                    
                    $getBookings =Booking::whereIN('driver_id',$driver)->where('status','service_completed')->where('payment_status','success')->get();
                    // echo '<pre>';print_r($driver); die;
            
                            $data=[];
                            foreach($getBookings as $getBooking){
                                
                                $jobReceivers =JobReceiver::with('DestinationAddres')->where('job_id',$getBooking->job_id)->get();

                                $pricing    =   Pricing::first();


                                // $commission=(($getBooking->quote_amount*$pricing->commission)/100)*(1+$pricing->tax/100); 

                                // $checkUserCommission = User::select('commission')->where('id',$getBooking->user_id)->first();

                                // if(!empty($checkUserCommission)){
                                //     $userCommission =$checkUserCommission->commission;

                                //     if($userCommission!='' && $userCommission!=null){
                                        
                                //         $commission=(($getBooking->quote_amount*$userCommission)/100)*(1+$pricing->tax/100);

                                //     }
                                // }


                                $commission=(($getBooking->quote_amount*$pricing->commission)/100); 

                                $tax = $pricing->tax;

                                $checkUserCommission = User::where('id',$getBooking->driver_id)->first();

                                if(!empty($checkUserCommission->transporter)){
                                    $userCommission =@$checkUserCommission->transporter->commission;

                                    if($userCommission!='' && $userCommission!=null){
                                        
                                        //$commission=(($getBooking->quote_amount*$userCommission)/100)*(1+$pricing->tax/100); //code commented by govind 20-jun 2024
                                        $commission=(($getBooking->quote_amount*$userCommission)/100);
                                    // $tax = $userCommission; //code commented by govind 20-jun 2024
                                    } 
                                }



                                $total_amount_tax = $commission;           

                                // $total_amount_without_tax =$total_amount_tax/(1+($tax/100)); //code commented by govind 20-jun 2024
                                 $total_amount_without_tax =($total_amount_tax*$tax)/100;
                         
                                // $tax_price = round($total_amount_tax-$total_amount_without_tax,2); //code commented by govind 20-jun 2024
                                 $tax_price =$total_amount_without_tax;


                                

 
                                if($getBooking->job->product->name=='Other') {

                                    $title=$getBooking->job->other;                    
                        
                                }else{
                                    $title=$request->type == 2?$getBooking->job->product->arabic_name:$getBooking->job->product->name;
                        
                                } 
                    

                                $data[]=[
                                    'book_id'      =>$getBooking->book_id,
                                    'booked_on'    =>$getBooking->booked_on,
                                    'invoice_no'   =>$getBooking->invoice_no,
                                    'booking_status' =>$getBooking->status,
                                        //'invoice_no'   => 'invoice-'.date('Yms').$getBooking->id,
                                    'user'=>[
                                        'name'                =>@$getBooking->user->name,
                                        'email'               =>@$getBooking->user->email, 
                                        'phone_number'        =>@$getBooking->user->country_code.@$getBooking->user->phone_number,
                                        'city'                =>@$getBooking->user->city, 
                                    ],

                                    'transporter'=>[
                                        "name"=>@$getBooking->driver->transporter->name,
                                        "pta_license_number"=>@$getBooking->driver->transporter->transporterDetails->pta_license_number,

                                    ],

                                    'driver'=>[
                                        'name'                =>@$getBooking->driver->name,
                                        'email'               =>@$getBooking->driver->email,
                                        'email'               =>@$getBooking->driver->email,
                                        'phone_number'        =>@$getBooking->driver->country_code.@$getBooking->driver->phone_number,
                                        'city'                =>@$getBooking->driver->city,
                                    ], 
                                    'job'=>[
                                        'title'               =>@$title, 
                                        'job_id'              =>@$getBooking->job->job_ID,
                                        'schedule_date'       =>@$getBooking->job->schedule_date,
                                        'schedule_time'       =>@$getBooking->job->schedule_time,
                                        'pick_up_address'     =>@$getBooking->job->pick_up_address,
                                        'city'                =>@$getBooking->pickupSubRegion->name,
                                        'total_goods_weight'  =>@$getBooking->job->total_goods_weight,
                                        'description_of_goods'=>@$getBooking->job->description_of_goods,
                                        'number_of_items'     =>@$getBooking->job->number_of_items, 
                                        'sub_amount'          =>@$getBooking->quote_amount,
                                        'status'              =>@$getBooking->job->status,
                                        'vehicle_type'        =>@$getBooking->vehicle_name,
                                    ],

                                    'tota'=>[
                                        'sub_amount'            =>@$getBooking->quote_amount,
                                        'discount'              =>@$getBooking->discount,
                                        'tax_price'             =>@$tax_price,
                                        'booking_fee'           =>@$getBooking->booking_fee,
                                        'commssion'             =>@$commission,
                                        'penaltiy_amount'       =>@$getBooking->penaltiy_amount,
                                    ],
                                    'jobReceivers' =>$jobReceivers
                                ];
                                }
                            
                                
                            $pdf = PDF::loadView('reports.invoice', compact('data'));
                            // $path = public_path('pdf/');      
                            // $fileName =  time().'.'. 'pdf' ;
                            // $pdf->save($path . '/' . $fileName);

                            // $pdf = public_path('pdf/'.$fileName);
                            return $pdf->download('Transporter_Invoices.pdf'); 
                        
                        break;





                }

    }


public function downloadUserInvoice(Request $request){







    // echo '<pre>'; print_r($request->all()); die;
    $jobDetails = Job::where('id',$request->job_id)->first();
    $productTypeDetails = Product::where('id',$jobDetails->product_id)->first();
    // echo '<pre>'; print_r($productTypeDetails->name); die; 
    if($request->type=='transporter'){


        $datas = [
            'job_id' => $request->job_id,   
            'transpoeter_base_price' =>  $request->transpoeter_base_price,
            'transpoeter_tax' =>  $request->transpoeter_tax,
            'transpoeter_commission' =>  $request->transpoeter_commission,
            'transpoeter_language_code' =>  $request->language_code,
            'transpoeter_type' =>  $request->type,
        ];
        
     
        
        
    $updateBooking=DB::table('bookings')->where('job_id',$request->job_id)->update(['quote_amount'=>$request->transpoeter_base_price,'tax_price'=>$request->transpoeter_tax,'booking_fee'=>$request->transpoeter_base_price,'transporter_base_price'=>$request->transpoeter_base_price,'transporter_tax'=>$request->transpoeter_tax,'transporter_commission'=>$request->transpoeter_commission]);
    }else{

        $datas = [
            'job_id' => $request->job_id,
            'user_base_price' =>  $request->user_base_price,
            'user_tax' =>  $request->user_tax,
            'user_commission' =>  $request->user_commission,
            'user_language_code' =>  $request->language_code,
            'user_type' =>  $request->type, 
        ];



    $updateBooking=DB::table('bookings')->where('job_id',$request->job_id)->update(['quote_amount'=>$request->user_base_price,'tax_price'=>$request->user_tax,'booking_fee'=>$request->user_base_price,'user_base_price'=>$request->user_base_price,'user_tax'=>$request->user_tax,'user_commission'=>$request->user_commission]);

    }
    
    JobsPaymentDetails::updateOrCreate(
        ['job_id' =>  $request->job_id],  
        $datas                           
    );


    $getBooking =Booking::where('job_id',$request->job_id)->with('user','driver','job')->first(); 
    // echo '<pre>'; print_r($getBooking); die;
    if($request->type=='transporter'){

    $updateBooking=DB::table('bookings')->where('job_id',$request->job_id)->update(['quote_amount'=>$request->transpoeter_base_price,'tax_price'=>$request->transpoeter_tax,'booking_fee'=>$request->transpoeter_base_price]);

    $receiveQuotesData['user_id']=$getBooking->user_id;
    $receiveQuotesData['job_id']=$request->job_id; 
    $receiveQuotesData['driver_id']=$getBooking->driver_id;
    $receiveQuotesData['quote_amount']=$request->transpoeter_base_price;
    $receiveQuotesData['status']='accepted';
    $receiveQuotesData['is_accepted']=1;
    $receiveQuotesData['is_payment']=1;
    $receiveQuotesData['is_quotes_post']=1; 
    $receiveQuotesData['is_active_date']=Carbon::now()->addMinute(60);

    $request_quotes=ReceiveQuotes::create($receiveQuotesData);
    }
    // dd($getBooking);
    $jobReceivers =JobReceiver::with('DestinationAddres')->where('job_id',$getBooking->job_id)->get();


    
    if($request->type=='transporter'){

    $sub_amount=$getBooking->quote_amount;
    $commission=(($request->transpoeter_base_price*$request->transpoeter_commission)/100)*(1+$request->transpoeter_tax/100); 
    $booking_fee=@$getBooking->booking_fee-$commission;

    }else{

    $sub_amount=$request->user_base_price;
    $commission=(($request->user_base_price*$request->user_commission)/100)*(1+$request->user_tax/100); 
    $booking_fee=@$getBooking->booking_fee+$commission;

    }      

    // $title=$getBooking->job->other;
    if($request->language_code=='ar'){
    $title=$productTypeDetails->arabic_name;
    }else{
    $title=$productTypeDetails->name;   
    }

    // $percentage = 15;
    // $totalWidth = 50000;

    // $total_tax = $commission-($commission/(1+@$getBooking->tax_price/100));
    // $total_tax = round($total_tax,2); 

    $pricing    =   Pricing::first();
    $tax = $pricing->tax;
    $checkUserCommission = User::select('commission')->where('id',$getBooking->user_id)->first();

        if(!empty($checkUserCommission)){
            $userCommission =$checkUserCommission->commission;

            if($userCommission!='' && $userCommission!=null){
                
                $commission=(($getBooking->quote_amount*$userCommission)/100)*(1+$pricing->tax/100);
                $tax = $userCommission;
            } 
        }

    $total_amount_tax = $commission;           

    $total_amount_without_tax =$total_amount_tax/(1+($tax/100));

    $total_tax = round($total_amount_tax-$total_amount_without_tax,2);
     
    $data[]=[
            'book_id'      =>$getBooking->book_id,
            'booked_on'    =>$getBooking->booked_on,
            'invoice_no'   =>$getBooking->invoice_no,
            'booking_status' =>$getBooking->status,
                //'invoice_no'   => 'invoice-'.date('Yms').$getBooking->id,
            'user'=>[
                'name'                =>@$getBooking->user->name,
                'email'               =>@$getBooking->user->email, 
                'phone_number'        =>@$getBooking->user->country_code.@$getBooking->user->phone_number,
                'city'                =>@$getBooking->user->city, 
                'type'                =>@$request->type,
            ],

            'transporter'=>[
                "name"=>@$getBooking->driver->transporter->name,
                "pta_license_number"=>@$getBooking->driver->transporter->transporterDetails->pta_license_number,

            ],

             
            'job'=>[
                'title'               =>@$title, 
                'job_id'              =>@$getBooking->job->job_ID,
                'schedule_date'       =>@$getBooking->job->schedule_date,
                'schedule_time'       =>@$getBooking->job->schedule_time,
                'pick_up_address'     =>@$getBooking->job->pick_up_address,
                'city'                =>@$getBooking->pickupSubRegion->name,
                'total_goods_weight'  =>@$getBooking->job->total_goods_weight,
                'description_of_goods'=>@$getBooking->job->description_of_goods,
                'number_of_items'     =>@$getBooking->job->number_of_items,
                'vehicle_type'     =>@$getBooking->vehicle_name, 
                'sub_amount'          =>$sub_amount,
                'status'              =>@$getBooking->job->status,
            ],

            'tota'=>[
                'sub_amount'            =>$sub_amount,
                'discount'              =>@$getBooking->discount,
                'tax_price'             =>$total_tax,
                'booking_fee'           =>$booking_fee,
                'commssion'             =>@$commission,
                'penaltiy_amount'       =>@$getBooking->penaltiy_amount,
            ],
            'jobReceivers' =>$jobReceivers
        ];
        // echo '<pre>'; print_r($data); die;
        if($request->language_code=='ar'){
            $pdf = PDF::loadView('reports.invoice_manually_ar', compact('data'));
            return $pdf->download('فاتور.pdf');
        }else{
            $pdf = PDF::loadView('reports.invoice_manually', compact('data'));
            return $pdf->download(''.$request->type.'_Invoices.pdf');
        }
        
        
     
}

public function downloadUserPastInvoice(Request $request){

    // echo '<pre>'; print_r($request->all()); die;

    
    $getBooking =Booking::where('job_id',$request->job_id)->with('user','driver','job')->first(); 
 
    // dd($getBooking);
    $jobReceivers =JobReceiver::with('DestinationAddres')->where('job_id',$getBooking->job_id)->get();

    if($request->type=='transporter'){
    $sub_amount=$getBooking->transporter_base_price;

    $commission=(($getBooking->transporter_base_price*$getBooking->transporter_commission)/100)*(1+$getBooking->transporter_tax/100); 
    $booking_fee=@$getBooking->booking_fee-$commission;
    $sub_amount=$getBooking->quote_amount;
    $total_tax =  $sub_amount-($sub_amount/(1+@$getBooking->transporter_tax/100));
    $total_tax =round($total_tax,2);
    }else{
    $sub_amount=$getBooking->user_base_price;
    $commission=(($getBooking->user_base_price*$getBooking->user_commission)/100)*(1+$getBooking->user_tax/100); 
    $booking_fee=@$getBooking->booking_fee+$commission;
    $sub_amount=$getBooking->quote_amount;
    $total_tax =  $sub_amount-($sub_amount/(1+@$getBooking->user_tax/100));
    $total_tax =round($total_tax,2);
    }  

    $title=$getBooking->job->other;
 
    

    // echo $total_tax; die;
    $data[]=[
            'book_id'      =>$getBooking->book_id,
            'booked_on'    =>$getBooking->booked_on,
            'invoice_no'   =>$getBooking->invoice_no,
            'booking_status' =>$getBooking->status,
                //'invoice_no'   => 'invoice-'.date('Yms').$getBooking->id,
            'user'=>[
                'name'                =>@$getBooking->user->name,
                'email'               =>@$getBooking->user->email, 
                'phone_number'        =>@$getBooking->user->country_code.@$getBooking->user->phone_number,
                'city'                =>@$getBooking->user->city, 
            ],

            'transporter'=>[
                "name"=>@$getBooking->driver->transporter->name,
                "pta_license_number"=>@$getBooking->driver->transporter->transporterDetails->pta_license_number,

            ],

             
            'job'=>[
                'title'               =>@$title, 
                'job_id'              =>@$getBooking->job->job_ID,
                'schedule_date'       =>@$getBooking->job->schedule_date,
                'schedule_time'       =>@$getBooking->job->schedule_time,
                'pick_up_address'     =>@$getBooking->job->pick_up_address,
                'city'                =>@$getBooking->pickupSubRegion->name,
                'total_goods_weight'  =>@$getBooking->job->total_goods_weight,
                'description_of_goods'=>@$getBooking->job->description_of_goods,
                'number_of_items'     =>@$getBooking->job->number_of_items, 
                'sub_amount'          =>$sub_amount,
                'status'              =>@$getBooking->job->status,
            ],

            'tota'=>[
                'sub_amount'            =>$sub_amount,
                'discount'              =>@$getBooking->discount,
                'tax_price'             =>$total_tax,
                'booking_fee'           =>$booking_fee,
                'commssion'             =>@$commission,
                'penaltiy_amount'       =>@$getBooking->penaltiy_amount,
            ],
            'jobReceivers' =>$jobReceivers
        ];
        // echo '<pre>'; print_r($data); die;
        if($request->language_code=='ar'){
            $pdf = PDF::loadView('reports.invoice_manually_ar', compact('data'));
            return $pdf->download('فاتور.pdf');
        }else{
            $pdf = PDF::loadView('reports.invoice_manually', compact('data'));
            return $pdf->download(''.$request->type.'_Invoices.pdf');
        }
        
        
     
}


}
