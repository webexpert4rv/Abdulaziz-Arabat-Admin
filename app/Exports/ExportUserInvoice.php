<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Booking;
use App\Models\JobReceiver;
use App\Models\Pricing;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Config;
use MPDF;
use PDF;
class ExportUserInvoice implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $userId,$userType;

    public function __construct($userId=null,$userType)
    {
        $this->userId = $userId; 
        $this->userType=$userType;
        
    }

    public function collection()
    {
        
        $getBookings =Booking::where('user_id',$this->userId)->where('payment_status','success')->with('user','driver','job')->get();

        
        $data=[];
        foreach($getBookings as $getBooking){
             
            $jobReceivers =JobReceiver::with('DestinationAddres')->where('job_id',$getBooking->job_id)->get();

            $pricing    =   Pricing::first();
            $commission=(($getBooking->quote_amount*$pricing->online_payment_discount)/100)*(1+$pricing->tax/100); 

            $checkUserCommission = User::select('commission')->where('id',$getBooking->user_id)->first();

            if(!empty($checkUserCommission)){
                $userCommission =$checkUserCommission->commission;

                if($userCommission!='' && $userCommission!=null){
                    
                    $commission=(($getBooking->quote_amount*$userCommission)/100)*(1+$pricing->tax/100);

                }
            }


               $title=$getBooking->job->other;
 

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
                ],

                'tota'=>[
                    'sub_amount'            =>@$getBooking->quote_amount,
                    'discount'              =>@$getBooking->discount,
                    'tax_price'             =>@$getBooking->tax_price,
                    'booking_fee'           =>@$getBooking->booking_fee,
                    'commssion'             =>@$commission,
                    'penaltiy_amount'       =>@$getBooking->penaltiy_amount,
                ],
                'jobReceivers' =>$jobReceivers
            ];
            }
        
             
        $pdf = PDF::loadView('reports.invoice', compact('data'));
        $path = public_path('pdf/');      
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);
        return $pdf->download('pdf_file.pdf');  
       
    }

    public function headings(): array
    {
        return [
            "User Id", 
            "Email", 
            "Name",
            "Acount Type",
            "Created At",
            
        ];
    }
    public function map($user) : array 
    {
        if($user->account_type==0){
            $account_type='User Personal';
        }
        elseif($user->account_type==1){
            $account_type='User Business';
        }
        elseif($user->account_type==2){
            $account_type='Transporter';
        }
        elseif($user->account_type==3){
            $account_type='Transporter';
        }
        return [
            @$user->unique_ID,
            @$user->email,
            @$user->name,
            @$account_type,
            date('d/m/Y',strtotime(@$user->created_at)),
        ];
    }

}
