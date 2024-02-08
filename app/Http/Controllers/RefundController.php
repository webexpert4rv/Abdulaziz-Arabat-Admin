<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Config;
use App\Models\UserRefund;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportUserAccount;
class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users      =   User::withSum('userRefunds','refund_amount')
                            ->withSum('transaction','amount')
                            ->where('role_id',Config::get('variables.User'))
                            ->whereHas('booking',function($q){
                                $q->where('status','=','cancelled');
                            })->get();
                           
        $total      =   Transaction::whereHas('booking',function($q){
                                    $q->where('status','=','cancelled');
                                })->sum('amount');  
        $total_refund_amount    =   UserRefund::sum('refund_amount');
         
       return view('refunds.index',compact('users','total','total_refund_amount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data['refund_amount']      =  $request->pay_amount;
        $data['admin_id']           =  auth()->user()->id;
        $data['user_id']            =  $request->user_id;
        $date                       =  date_create($request->paid_date);
        $data['refund_date']        =  date_format($date,"Y-m-d");
        UserRefund::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {


        if($request->ajax()){
            $users      =   User::
                            withSum('userRefunds','refund_amount')
                            ->withSum('transaction','amount')
                            ->where('role_id',Config::get('variables.User'))
                            ->whereHas('booking',function($q){
                                $q->where('status','!=','cancelled');
                            })->where('id',$id)->first();
 

            $total          =   $users->transaction_sum_amount;
            $total_paid     =   UserRefund::where('user_id',$id)->sum('refund_amount');
          
            $total_remaining =$total-($total_paid);
         
                return response()->json([
                    'total'                     => $total ,
                    'total_paid'                => $total_paid ,
                    'user_name'                 => $users->name,
                    'total_payble'              => $total_remaining ,
                  
                ]);
        }
        $user_refund=UserRefund::where('user_id',$id)->get();
        $user  =User::where('id',$id)->first();
        return view('refunds.view',compact('user_refund','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function refundPaymentValidation(Request $request){
      
        if($request->pay_amount>$request->total_payble){
            return response()->json([
                'status'=>false,
                'message'=>'Amount is greater than payble amount'
            ]);
        }else{
            return response()->json([
                'status'=>true,
                'message'=>'success',
            ]);
        }
       
       
    }

    public function exportUserAccount(Request $request){
        $search     =        $request->search?$request->search:null;
        $type     =          $request->type?$request->type:null;
        $date       =        $request->date_range?explode('-',$request->date_range):null;
        return Excel::download(new ExportUserAccount($search,$date,$type), 'user-account-statement.xlsx');
    }



}
