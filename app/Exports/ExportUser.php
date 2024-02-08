<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Config;
class ExportUser implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $search,$date,$type;

    public function __construct($search=null,$date=null,$type)
    {
        $this->search = $search;
        $this->date = $date;
        $this->type=$type;
        
    }

    public function collection()
    {
        $users=new User;
        if(!empty($this->date)){
           
                $users = $users->where('created_at','>=',date('Y-m-d',strtotime($this->date[0])))->where('created_at','<=',date('Y-m-d',strtotime($this->date[1])));
        }
        if($this->type=='user'){
            $users = $users->where('role_id',Config::get('variables.User'));
        }
        if($this->type=='transporter'){
            $users = $users->where('role_id',Config::get('variables.Transporter'));
        }
        if($this->search!="on"){
        
            $search=$this->search;
             $users= $users->where(function($q) use($search){
                    $q->where('unique_ID','like', '%' . $search.'%');
                    $q->orWhere('created_at','like', '%' . $search.'%');
                    $q->orWhere('email','like', '%' . $search.'%');
                    $q->orWhere('name','like', '%' . $search.'%');
                    $q->orWhere('account_type','like', '%' . $search.'%');
                });
              
        }
         return $users->get();
       
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
