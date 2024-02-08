<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Config;
use App\Models\Pricing;
use App\Models\Booking;
use App\Models\TransporterWallet;
class ExportTransporterAccount implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $search,$date,$type;

    public function __construct($search=null,$date=null,$type=null)
    {
        $this->search = $search;
        $this->date = $date;
        $this->type=$type;
        
    }

    public function collection()
    {
        $transporters=new User;
         
         
        $transporters = $transporters->where('role_id',Config::get('variables.Transporter'))->get();
        
        $GrandTotalAmount=0;
        $GrandTotalcommission=0;
        $GrandTotalpaid_amount=0;
        $GrandTotalremaining_amount=0;
        foreach($transporters as $key=> $transporter){
            $pricing                =   Pricing::first(); 
            $drivers_ids            =   User::where('parent_id',$transporter->id)->pluck('id'); 
            
            

            $quote_amount =Booking::where('status','service_completed')->whereIn('driver_id',$drivers_ids)->sum('quote_amount'); 


            $commission=($quote_amount*$pricing->commission/100)*(1+$pricing->tax/100);
            $totalAmount=$quote_amount-$commission;
            $paid_amount            =   TransporterWallet::where('transporter_id',$transporter->id)->sum('amount');

            $remaining_amount       =   $totalAmount-($paid_amount);
            $payble_Amount          =   $remaining_amount;

            if($totalAmount==0 || $totalAmount==''){
                $totalAmount='0';
            }
            if($commission==0 || $commission==''){
                $commission='0';
            }
            if($paid_amount==0 || $paid_amount==''){
                $paid_amount='0';
            }
            if($remaining_amount==0 || $remaining_amount==''){
                $remaining_amount='0';
            }
            $transporter['srno']=$key+1;
            $transporter['totalAmount']=$totalAmount;
            $transporter['commission']=$commission;
            $transporter['paid_amount']=$paid_amount;
            $transporter['remaining_amount']=$remaining_amount;

            $GrandTotalAmount=$GrandTotalAmount+$totalAmount;
            $GrandTotalcommission=$GrandTotalcommission+$commission;
            $GrandTotalpaid_amount=$GrandTotalpaid_amount+$paid_amount;
            $GrandTotalremaining_amount=$GrandTotalremaining_amount+$remaining_amount;
        }
        // echo '<Pre>'; print_r($transporters); die;

        $transporter['srnol']='';
        $transporter['Total']='';
        $transporter['GrandTotalAmount']='Total Amount:-  '.$GrandTotalAmount;
        $transporter['GrandTotalcommission']='Total Commission:-  '.$GrandTotalcommission;
        $transporter['GrandTotalpaid_amount']='Total Paid Amount:-  '.$GrandTotalpaid_amount;
        $transporter['GrandTotalremaining_amount']='Total Remaining Amount:-  '.$GrandTotalremaining_amount;
        return $transporters;
       
    }

    public function headings(): array
    {
        return [
            "Sr.No.", 
            "Name", 
            "Total Amount",
            "Commission",
            "Paid Amount",
            "Remaining Amount",
            
        ];

    }
    public function map($transporters) : array 
    {
         
        return [
            @$transporters->srno,
            @$transporters->name,
            @$transporters->totalAmount, 
            @$transporters->commission, 
            @$transporters->paid_amount, 
            @$transporters->remaining_amount,

            @$transporters->Total,
            @$transporters->GrandTotalAmount,
            @$transporters->GrandTotalcommission,
            @$transporters->GrandTotalpaid_amount,
            @$transporters->GrandTotalremaining_amount,  
        ];
    }

}
