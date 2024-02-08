<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
class TransactionExport implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $search,$date;

    public function __construct($search=null,$date=null)
    {
        $this->search = $search;
        $this->date = $date;
    }
    public function collection()
    {
        $transaction= new Transaction;

        if(!empty($this->date)){
                $transaction = $transaction->where('created_at','>=',date('Y-m-d',strtotime($this->date[0])))->where('created_at','<=',date('Y-m-d',strtotime($this->date[1])));
        }
        if(!empty($this->search)){
            $search=$this->search;
            $transaction= $transaction->where(function($q) use($search){
                                $q->orWhere('created_at','like', '%' . $search.'%');
                                $q->orWhere('transaction_id','like', '%' . $search.'%');
                                $q->orWhere('amount','like', '%' . $search.'%');
                            });
        }
        return  $transaction->get();
    }
    public function headings(): array
    {
        return [
            "Transaction Id", 
            "User Name", 
            "Driver Name",
            "Booked On",
            "Booking Amount",
            "Status", 
        ];
    }
    public function map($transaction) : array 
    {
        return [
            @$transaction->transaction_id,
            @$transaction->user->name,
            @$transaction->driver->name,
            date('d/m/Y',strtotime(@$transaction->booked_on)),
            @$transaction->amount,
            @$transaction->status,
        ];
    }
}
