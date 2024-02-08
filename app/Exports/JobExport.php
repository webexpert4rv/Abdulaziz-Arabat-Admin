<?php

namespace App\Exports;

use App\Models\Job;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
class JobExport implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $search,$date,$status;

    public function __construct($search=null,$date=null,$status=null)
    {
        $this->search = $search;
        $this->date = $date;
        $this->status = $status;
    }
    public function collection()
    { 

 
        $data =Job::with('product','PickupRegion','PickupSubRegion','JobReceiver')
        ->with('JobReceiver',function($q){
            $q->with('DestinationRegion');

        })->orderBy('id','DESC');

        if(!empty($this->date)){

            $data->where('created_at','>=',date('Y-m-d',strtotime($this->date[0])))->where('created_at','<=',date('Y-m-d',strtotime($this->date[1])));
        }
        /* if(!empty($this->search)){
            $search=$this->search;
           
             $data->where(function($q) use($search){
                                $q->where('job_ID','like', '%' . $search.'%');
                                $q->orWhere('created_at','like', '%' . $search.'%');
                                $q->orWhere('title','like', '%' . $search.'%');
                                $q->orWhere('schedule_date','like', '%' . $search.'%');
                                $q->orWhere('schedule_time','like', '%' . $search.'%');
                                $q->orWhere('number_of_vehicle','like', '%' . $search.'%');
                                $q->orWhere('status','like', '%' . $search.'%');
                            });
        }*/         

          if (!empty($this->status)) {
            $data->where('status',$this->status);
        }
 
        return   $data->get(); 








    }
    public function headings(): array
    {
        return [
            "Job ID", 
            "Title", 
            "Schedule Date", 
            "Schedule Time",
            "Pickup Address",
            "Destination Address",
            "Number Of Vehicle", 
            "Status", 
        ];
    }
    public function map($job) : array 
    {
        return [
            @$job->job_ID,
            @$job->title,
            date('d/m/Y',strtotime(@$job->schedule_date)),
            date('h:i A',strtotime(@$job->schedule_time)),
            @$job->PickupRegion->name.' '.$job->PickupSubRegion->name,
            @$job->JobReceiver->DestinationRegion->name.' '.@$job->JobReceiver->DestinationSubRegion->name,
            @$job->number_of_vehicle,
            @$job->status,
        ];
    }
}
