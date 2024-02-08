<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Exports\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DataTables;
class PaymentsController extends Controller
{


    public function index(Request $request)
    { 

        if ($request->ajax()) { 

            $data = Transaction::with('driver','user','booking','job')->orderByDesc('created_at');

            
            if (!empty($request->date_range[0])) {
                $date_range = $request->date_range; 
                $data->whereDate('created_at','>=',date('Y-m-d',strtotime($date_range[0])))
                ->whereDate('created_at','<=',date('Y-m-d',strtotime($date_range[1])));
            }            

            $getData=$data->get();

            return Datatables::of($getData)
            ->addIndexColumn()             

            ->addColumn('job_ID', function($row){
                $btn =  @$row->job->job_ID ;
                return $btn;
            })
            ->addColumn('date', function($row){
                $btn =  date('d/m/Y',strtotime($row->created_at)) ;
                return $btn;
            })
                  

            ->addColumn('status', function($row){
                $btn = ucfirst(str_replace('_', ' ', @$row->status));
                return $btn;
            })


            ->addColumn('action', function($row){



                $btn1=$btn2='';
                if(auth()->user()->can('view_payment'))
                {
                    $btn1= '<a class="action-button" title="Job Details" href="javascript.void();"  data-toggle="modal" data-target="#exampleModal-'.$row->id.'"><i class="text-info fa fa-eye"></i></a> 
                   <a class="action-button" title="Job Details" href='.route('jobs.show',$row->job_id).'><i class="fa fa-link" aria-hidden="true"></i></a>';

                     if($row->bank_rceipt){

                      $btn2=   '<a href='.config('services.storage_image_path.image_path').'/'.$row->bank_rceipt.' target="_blank"  class="action-button btn btn-danger"  download>
                 Rrceipt Download </a>';
                     }
     
     




                }

                
                return $btn1. $btn2;
            }) 


            ->rawColumns(['job_ID','date','status','action'])
            ->make(true);

            return view('payments.index');
        }

        $transactions=Transaction::with('driver','user','booking','job')->orderByDesc('id')->get();

        return view('payments.index',compact('transactions'));
    }

    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction=Transaction::where('id',$id)->with('driver','user')->first();

        return view('payments.view',compact('transaction'));
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

    public function filetrPayment(Request $request){
      $date_range = $request->date_range;

      $transactions = Transaction::with('driver','user')->orderByDesc('created_at')->whereDate('created_at','>=',date('Y-m-d',strtotime($date_range[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($date_range[1])))->get();

      $result_view = view('payments.partial',['transactions'=>$transactions])->render();
      return json_encode(['html'=> $result_view,'status'=>true]);
  }

  public function resetPayment(Request $request){

      $transactions = Transaction::with('driver','user')->get();

      $result_view = view('payments.partial',['transactions'=>$transactions])->render();
      return json_encode(['html'=> $result_view,'status'=>true]);

  }
  public function exportPayment(Request $request){
    $search     =        $request->search?$request->search:null;
    $date       =        $request->date_range?explode('-',$request->date_range):null;
    return Excel::download(new TransactionExport($search,$date), 'transaction.xlsx');
}
public function csvPayment(Request $request){
    $search     =        $request->search?$request->search:null;
    $date       =        $request->date_range?explode('-',$request->date_range):null;
    return (new TransactionExport($search,$date))->download('transaction.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
}

public function pdfPayment(Request $request){
    $search     =        $request->search?$request->search:null;
    $date       =        $request->date_range?explode('-',$request->date_range):null;

    $transaction=new Transaction;
    if(!empty($date)){
        $transaction = $transaction->where('created_at','>=',date('Y-m-d',strtotime($date[0])))->where('created_at','<=',date('Y-m-d',strtotime($date[1])));
    }
    if(!empty($search)){
        $transaction= $transaction->where(function($q) use($search){
            $q->orWhere('created_at','like', '%' . $search.'%');
            $q->orWhere('transaction_id','like', '%' . $search.'%');
            $q->orWhere('amount','like', '%' . $search.'%');

        });
    }
    $transaction=$transaction->get();
    $data = [
     'transactions'=>$transaction,
 ];
 $pdf        = PDF::loadView('pdf.payment', $data);
 return $pdf->download('payment.pdf');

}
}
