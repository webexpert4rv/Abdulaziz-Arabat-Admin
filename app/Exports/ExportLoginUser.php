<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Config;
class ExportLoginUser implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $search,$date,$type;

    

    public function collection()
    {
        $users=new User;
        $users = $users->where('role_id',Config::get('variables.User'))->where('login_status','1');
         
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
