<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Config;
use App\Models\Job; 
use App\Models\ReceiveQuotes;
use Carbon\Carbon; 
class ExportUserQuations implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
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
        $jobLists = Job::where('user_id',$this->userId)
        ->orderBy('is_active_date','DESC')
        ->where('status','pending')                      
        ->where('is_active','1')
        ->with('product')
        ->with('PickupRegion','PickupSubRegion')         
        ->with('JobReceiver','JobReceivers')  
        ->withCount('booking')
        /*->whereHas('receiveQuotes',function($q){
            $q->where('status','!=','accepted');
        })*/
        ->get();
   

        $data=[];
        $totalQuotes=0;
        foreach ($jobLists as $key => $value){

            $userData=User::find($value->user_id);
            if (@$value->number_of_vehicle>='3') {

                $limit=10;
            }else{

                $limit=5;
            }

            //remove this commint multipal driver case and multipal boking
            // if (@$value->number_of_vehicle>$value->booking_count) {
            if (1>$value->booking_count) {

                $total_quotes =ReceiveQuotes::where('job_id',$value->id)
                ->limit($limit)   
                ->isExpired()                 
                ->whereIn('status',['pending','payment-pending']) 
                ->where('is_accepted','1')
                ->get();


                $destination=[];

                foreach ($value->JobReceivers as $key => $receiverDestination) {

                    $destinationSubRegion=\Session::get('language')=="ar"?$receiverDestination->DestinationSubRegion->arabic_name:Auth()->user()->language_code=="ur"?$receiverDestination->DestinationSubRegion->arabic_name:$receiverDestination->DestinationSubRegion->name;

                    $destinationRegion=\Session::get('language')=="ar"?$receiverDestination->DestinationRegion->arabic_name:Auth()->user()->language_code=="ur"?$receiverDestination->DestinationRegion->arabic_name:$receiverDestination->DestinationRegion->name;

                    $destination[]= @$destinationSubRegion.', '.@$destinationRegion;

                }

                $pickupSubRegion=\Session::get('language')=="ar"?@$value->PickupSubRegion->arabic_name:Auth()->user()->language_code=="ur"?@$value->PickupSubRegion->arabic_name:@$value->PickupSubRegion->name;

                $pickupRegion=\Session::get('language')=="ar"?$value->PickupRegion->arabic_name:Auth()->user()->language_code=="ur"?$value->PickupRegion->arabic_name:$value->PickupRegion->name;

                $totalQuotes+=count($total_quotes);

                if (count($total_quotes)) {
                    $scheduleDate =$value->receiveQuote->is_active_date;

                }else{
                    $scheduleDate =@$value->is_active_date;
                }


                if ($scheduleDate>=Carbon::now()->subDays(30)) {   

                    $data[]=[
                        'id'                    => @$value->id,
                        'user_id'               => @$userData->unique_ID, 
                        'job_ID'                => @$value->job_ID,

                        'title'               => \Session::get('language')=="ar"?$value->product->arabic_name:Auth()->user()->language_code=="ur"?$value->product->arabic_name:$value->product->name,

                        'number_of_vehicle'     => @$value->number_of_vehicle,
                        'booking_count'         => @$value->booking_count,
                        'is_active_date'        => @$value->is_active_date,                  
                        'schedule_date'         => @$value->schedule_date,                    
                        'schedule_time'         => @$value->schedule_time,
                        'pick_up_address'       => @$pickupSubRegion.', '.@$pickupRegion,

                        'destination_address'   => @$destination,                
                        'total_quotes'          => @count($total_quotes),
                        'rfq_status'            => @$value->rfq_status,
                        'schedule_date_status'  => @$value->is_active_date.' '.$value->is_active_date>=date('Y-m-d h:i')?1:0 ,
                        'Carbon'                => @date('d-m-Y h:i'),  
                        'deliveryNote'          => @$value->requirements,    
                        'created_at'            => @$value->created_at->format('Y-m-d'),           

                    ];
                 }
            }
        }  
        // echo '<pre>'; print_r($data); die;

        return collect($data);
       
    }

    public function headings(): array
    {
        return [
            "User Id", 
            "Job ID", 
            "Title",
            "Number of Vehicle", 
            "Schedule Date",
            "Schedule Time",
            "Pick up Address",
            "Destination Address",
            "Total Quotes",
            "RFQ Status", 
            "deliveryNote",
            "Created at",
            
        ];
    }
    public function map($data) : array 
    {
        
        return [
            @$data['user_id'],
            @$data['job_ID'],
            @$data['title'],
            @$data['number_of_vehicle'],  
            @$data['schedule_date'],
            @$data['schedule_time'],
            @$data['pick_up_address'],
            @$data['destination_address'],
            @$data['total_quotes'], 
            @$data['rfq_status'],  
            @$data['deliveryNote'], 
            @$data['created_at'], 
        ];
    }

}
