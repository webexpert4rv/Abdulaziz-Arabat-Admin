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
class ExportUserAccount implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
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
        $users      =   User::withSum('userRefunds','refund_amount')
                            ->withSum('transaction','amount')
                            ->where('role_id',Config::get('variables.User'))
                            ->whereHas('booking',function($q){
                                $q->where('status','=','cancelled');
                            })->get();
            $user_refunds_sum_refund_amount='0';
            $transaction_sum_amount='0';
            $GrandTotalAmount='0';
            $GrandTotalPaid='0';
            $GrandTotalpending_amount='0';
        foreach($users as $key=>$user){
            $remaining_amount=$user->transaction_sum_amount-($user->user_refunds_sum_refund_amount);

            if($user->user_refunds_sum_refund_amount==''){
                $user_refunds_sum_refund_amount='0';
            }else{
                $user_refunds_sum_refund_amount=$user->user_refunds_sum_refund_amount;
            }
            if($user->transaction_sum_amount==''){
                $transaction_sum_amount='0';
            }else{
                $transaction_sum_amount=$user->transaction_sum_amount;
            }
            if($remaining_amount==''){
                $remaining_amount='0';
            }
            $user['srno']=$key+1;
            $user['transaction_sum_amount']=$transaction_sum_amount;
            $user['user_refunds_sum_refund_amount']=$user_refunds_sum_refund_amount;
            $user['remaining_amount']=$remaining_amount;

            $GrandTotalAmount=$GrandTotalAmount+$transaction_sum_amount;
            $GrandTotalPaid=$GrandTotalPaid+$user_refunds_sum_refund_amount;
            $GrandTotalpending_amount=$GrandTotalpending_amount+$remaining_amount;
        }  

        $user['GrandTotalAmount']='Total Amount:-  '.$GrandTotalAmount;
        $user['GrandTotalPaid']='Total Paid Amount:-  '.$GrandTotalPaid;
        $user['GrandTotalpending_amount']='Total Pending Amount:-  '.$GrandTotalpending_amount;
        
        return $users;
       
    }

    public function headings(): array
    {
        return [
            "Sr.No.", 
            "User Name", 
            "Total Refundable Amount",
            "Total Paid Amount",
            "Total Remaining Amount", 
            
        ];

    }
    public function map($users) : array 
    {
         
        return [
            @$users->srno,
            @$users->name,
            @$users->transaction_sum_amount, 
            @$users->user_refunds_sum_refund_amount, 
            @$users->remaining_amount,  

            @$users->GrandTotalAmount,
            @$users->GrandTotalPaid,
            @$users->GrandTotalpending_amount,
        ];
    }

}
