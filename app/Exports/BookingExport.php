<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class BookingExport implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize,WithCustomStartCell
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    
    private $search,$date,$status,$user,$driver;

    public function __construct($search=null,$date=null,$status=null,$user=null,$driver=null)
    {
        $this->search = $search;
        $this->date = $date;
        $this->status = $status;
        $this->user = $user;
        $this->driver = $driver;
    }
    public function collection()
    {

        $booking = Booking::with('job')->with('driver',function($q){

            $q->with('transporter');

        });

        if(!empty($this->date)){

            $booking->where('booked_on','>=',date('Y-m-d',strtotime($this->date[0])))->where('booked_on','<=',date('Y-m-d',strtotime($this->date[1])));
        }

        if(!empty($this->search)){

            $search=$this->search;
            $booking->where(function($q) use($search){
                $q->where('book_id','like', '%' . $search.'%');
                $q->orWhere('booked_on','like', '%' . $search.'%');
                $q->orWhere('status','like', '%' . $search.'%');
                $q->orWhere('payment_status','like', '%' . $search.'%');
                $q->orWhere('booking_fee','like', '%' . $search.'%');
            });

        }

        if (!empty($this->status)) {
            $booking->where('status',$this->status);
        }


        if ($this->driver) {

            $booking->where('driver_id',$this->driver);
        }
        if ($this->user) {

            $booking->where('user_id', $this->user);
        }

        return   $booking->get(); 



    }

    public function headings(): array
    {
        return [
            "Booking Id", 
            "JobId", 
            "Booking Fee",
            "User Name", 
            "Driver Name",
            "Transporter Name",
            "Payment Status",
            "Booking Status",
            "booked On",             
        ];
    }
    public function map($booking) : array 
    {
        return [
            @$booking->book_id,
            @$booking->job->job_ID,
            @$booking->booking_fee,
            @$booking->user->name,
            @$booking->driver->name,
            @$booking->transporter_name,
            @$booking->payment_status,
            ucfirst(str_replace('_', ' ', @$booking->status)),            
            @$booking->booked_on, 



        ];
    }

    public function startCell(): string
    {
        return 'A2';
    }

}
