<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Config;
use App\Models\Transaction;
use App\Models\TransporterWallet;
use App\Models\Pricing;
use App\Models\Booking;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportTransporterAccount;
class TransporterWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $getPricing=Pricing::first();

        $tax =$getPricing->tax;
        $transporteCommission =$getPricing->commission;

        $transporters           =   User::where('role_id',Config::get('variables.Transporter'))->get();

        $quote_amount           =   Booking::where('status','service_completed')->sum('quote_amount');           

        $paid_amount            =    TransporterWallet::sum('amount');

        $paytax =round($quote_amount-($quote_amount/(1+$tax/100)),2);

        $commission=($quote_amount*$transporteCommission/100)*(1+$tax/100);

        $totalAmount=$quote_amount-$commission;

        $remaining_amount  =    $totalAmount-($paid_amount);

        // echo $quote_amount.'///'.$commission.'///'.$paid_amount; die;
        
        return view('wallets.index',compact('totalAmount', 'remaining_amount','transporters','commission','paid_amount'));
    }


    public function create()
    {

    }
    
    public function store(Request $request)
    {


     $total_payble                 =  $request->pay_amount;
     $pricing=Pricing::first();

     $totalAmount = $total_payble+(($total_payble*$pricing->commission/100)*(1+$pricing->tax/100));



     $data['amount']              =  $total_payble;
     $data['admin_commission']    =  ($totalAmount*$pricing->commission/100)*(1+$pricing->tax/100);
     $data['admin_id']            =  auth()->user()->id;
     $data['transporter_id']      =  $request->transporter_id;       
     $data['paid_date']           =  date('Y-m-d',strtotime(str_replace('/', '-', $request->date)));



     TransporterWallet::create($data);
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
            $pricing                =   Pricing::first();
            $transporter            =   User::where('id',$id)->first(); 
            $drivers_ids            =   User::where('parent_id',$id)->pluck('id'); 
            
            

            $quote_amount =Booking::where('status','service_completed')->whereIn('driver_id',$drivers_ids)->sum('quote_amount'); 


            $commission=($quote_amount*$pricing->commission/100)*(1+$pricing->tax/100);
            $totalAmount=$quote_amount-$commission;
            $paid_amount            =   TransporterWallet::where('transporter_id',$id)->sum('amount');

            $remaining_amount       =   $totalAmount-($paid_amount);
            $payble_Amount          =   $remaining_amount;

            $remaining_commission   =""; 

            return response()->json([
                'data'=>'Modal Open successfully',
                'name'=>$transporter->name,
                'total_amount'=>round($totalAmount,2),
                'commission'=>round($commission,2),
                'paid_amount'=> round($paid_amount,2),
                'remaining_amount'=>round($remaining_amount,2),
                'remaining_commission'=>round($remaining_commission,2),
                'payble_amount'=>round($payble_Amount,2),
                
            ]);
        }
        $transporter                =   User::where('id',$id)->first(); 
        $transporter_wallet_history =   TransporterWallet::where('transporter_id',$id)->get();

        return view('wallets.view',compact('transporter_wallet_history','transporter'));
        
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

    public function paymentValidation(Request $request){

        if($request->payamount>$request->total_payble){
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

    public function exportTransporterAccount(Request $request){
        $search     =        $request->search?$request->search:null;
        $type     =          $request->type?$request->type:null;
        $date       =        $request->date_range?explode('-',$request->date_range):null;
        return Excel::download(new ExportTransporterAccount($search,$date,$type), 'transporter-account-statement.xlsx');
    }




}
