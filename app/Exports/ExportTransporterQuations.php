<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Job; 
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Config;
class ExportTransporterQuations implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
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
       $drivers = User::select(['id','name','profile_image','is_online'])->where('is_online','1')->where('parent_id',$this->userId)
        ->with('vehicle')->get();

        $driver      =   User::where('parent_id',$this->userId)->pluck('id');


        $getDriverQuotations    =   Job::whereHas('requestQuotes',function ($q) use($driver){
            $q->whereIN('driver_id',$driver)
            ->whereIN('status',['pending','quote_post'])
            ->where('is_quotes_post','1') 
            
            ->where('is_active_date','>',Carbon::now()->subDays(1));
        })
        ->with('receiveQuote', function ($query) use($driver) {
            $query->whereIN('driver_id',$driver)
            ->with('driver')
            ->whereNotIn('status',['delivered','accepted']);
        })
        ->with('requestQuotes',function ($q) use($driver){
            $q->whereIN('driver_id',$driver); 
        })
        ->with('user','PickupRegion','PickupSubRegion')
        ->with('JobReceiver','JobReceivers') 
        ->orderBy('is_active_date', 'DESC'); 

        // echo '<pre>'; print_r($getDriverQuotations->get()); die;
         return $getDriverQuotations->get();
       
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
            
        ];
    }
    public function map($getDriverQuotations) : array 
    {
         
        return [
            @$getDriverQuotations->user_id,
            @$getDriverQuotations->job_ID,
            @$getDriverQuotations->title,
            @$getDriverQuotations->number_of_vehicle,  
            @$getDriverQuotations->schedule_date,
            @$getDriverQuotations->schedule_time,
            @$getDriverQuotations->pick_up_address,
            @$getDriverQuotations->destination_address,
            @$getDriverQuotations->total_quotes, 
            @$getDriverQuotations->rfq_status,  
            @$getDriverQuotations->deliveryNote,
        ];
    }

}
