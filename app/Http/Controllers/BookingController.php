<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Exports\BookingExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Models\User;
use DataTables;
class BookingController extends Controller
{

    public function index(Request $request){


        if ($request->ajax()) { 

            $data = Booking::Filetr($request)->with('job')->with('driver',function($q){
                $q->with('transporter');

            })->orderByDesc('booked_on');

            
            if (!empty($request->date_range[0])) {
                $date_range = $request->date_range; 
                $data->whereDate('created_at','>=',date('Y-m-d',strtotime($date_range[0])))
                ->whereDate('created_at','<=',date('Y-m-d',strtotime($date_range[1])));
            }

            if (!empty($request->booking_status)) {

                $data->where('status',$request->booking_status);

            }


            $getData=$data->get();

            return Datatables::of($getData)
            ->addIndexColumn()

            ->addColumn('job_ID', function($row){
                $btn =  @$row->job->job_ID ;
                return $btn;
            })
            ->addColumn('user_name', function($row){
                $btn =  @$row->user->name ;
                return $btn;
            })
            ->addColumn('driver_name', function($row){
                $btn =  @$row->driver->name ;
                return $btn;
            })
            ->addColumn('transporter_name', function($row){
                $btn =  @$row->driver->transporter->name ;
                return $btn;
            })

            ->addColumn('booked_on', function($row){
                $btn =  date('d/m/Y',strtotime($row->booked_on)) ;
                return $btn;
            })
                  

            ->addColumn('status', function($row){
                $btn = ucfirst(str_replace('_', ' ', @$row->status));
                return $btn;
            })


            ->addColumn('action', function($row){

                $btn1=$btn2=$btn3='';
                if(auth()->user()->can('view_job_booked'))
                {
                    $btn1= '<a class="action-button" title="View" href='.route('view-booking',$row->id).'><i class="text-info fa fa-eye"></i></a>';
                }

                
                return $btn1.$btn2.$btn3;
            }) 


            ->rawColumns(['job_ID','user_name','driver_name','transporter_name','PickupRegion','JobReceiver','status','action'])
            ->make(true);

            return view('booking.index');
        }




        $bookings    =   Booking::with('job')->with('driver',function($q){
            $q->with('transporter');

        })->orderByDesc('booked_on')->get();   

        $drivers= User::where('role_id',4)->get();
        $users= User::where('role_id',3)->get();

        return view('booking.index',compact('bookings','drivers','users'));

    }

    public function viewBooking(Request $request,$id){

        $booking  = Booking::where('id',$id)->with('user','job')->with('driver',function($q){
            $q->with('transporter');
        })->with('transaction')->first();

        return view('booking.view_booking',compact('booking'));
    }


    public function filetrBooking(Request $request){

        $date_range = $request->date_range;

        $bookings = Booking::orderByDesc('booked_on')
        ->Filetr($request)
        ->get();


        $result_view = view('booking.partial',['bookings'=>$bookings])->render();

        return json_encode(['html'=> $result_view,'status'=>true]);
    }

    public function resetBooking(Request $request){
        $page   =   $request->current;
        $limit  =   $request->limit;
        $offset =   ($limit * $page) -  $limit;
        $bookings       = Booking::orderByDesc('booked_on')->skip($offset)->take($limit)->get();

        $result_view    = view('booking.partial',['bookings'=>$bookings])->render();

        return json_encode(['html'=> $result_view,'status'=>true]);

    }

    public function exportBooking(Request $request){
 

        $search     =      $request->search?$request->search:null;
        $date       =      $request->date_range?explode('-',$request->date_range):null;
        $status     =      $request->status?$request->status:null;
        $user       =      $request->User_status?$request->User_status:null;
        $driver     =      $request->driver_status?$request->driver_status:null;


        return Excel::download(new BookingExport($search,$date,$status,$user,$driver), 'booking.xlsx');
    }

    public function pdfBooking(Request $request){

        $search     =        $request->search?$request->search:null;
        $date       =        $request->date_range?explode('-',$request->date_range):null;

        $status     =      $request->status?$request->status:null;
        $user       =      $request->User_status?$request->User_status:null;
        $driver     =      $request->driver_status?$request->driver_status:null;
       

        /*$booking=new Booking;
        if(!empty($date)){
            $booking = $booking->where('booked_on','>=',date('Y-m-d',strtotime($date[0])))->where('booked_on','<=',date('Y-m-d',strtotime($date[1])));
        }
        if(!empty($search)){
            $booking= $booking->where(function($q) use($search){
                $q->where('book_id','like', '%' . $search.'%');
                $q->orWhere('booked_on','like', '%' . $search.'%');
                $q->orWhere('status','like', '%' . $search.'%');
                $q->orWhere('payment_status','like', '%' . $search.'%');
                $q->orWhere('booking_fee','like', '%' . $search.'%');
            });
        }

       $booking=$booking->get();*/


        $booking = Booking::with('job')->with('driver',function($q){

            $q->with('transporter');

        });

        if(!empty($date)){

            $booking->where('booked_on','>=',date('Y-m-d',strtotime($date[0])))->where('booked_on','<=',date('Y-m-d',strtotime($date[1])));
        }

        if(!empty($search)){

            $search=$search;
            $booking->where(function($q) use($search){
                $q->where('book_id','like', '%' . $search.'%');
                $q->orWhere('booked_on','like', '%' . $search.'%');
                $q->orWhere('status','like', '%' . $search.'%');
                $q->orWhere('payment_status','like', '%' . $search.'%');
                $q->orWhere('booking_fee','like', '%' . $search.'%');
            });

        }

        if (!empty($status)) {
            $booking->where('status',$status);
        }


        if ($driver) {

            $booking->where('driver_id',$driver);
        }
        if ($user) {

            $booking->where('user_id', $user);
        }

       $bookings=   $booking->get(); 


        $data = [
            'bookings'=>$bookings
        ];
        $pdf        = PDF::loadView('pdf.booking', $data);
        return $pdf->download('booking.pdf');

    }

    public function csvBooking(Request $request){
        $search     =        $request->search?$request->search:null;
        $date       =        $request->date_range?explode('-',$request->date_range):null;

        $status     =      $request->status?$request->status:null;
        $user       =      $request->User_status?$request->User_status:null;
        $driver     =      $request->driver_status?$request->driver_status:null;


         
        return (new BookingExport($search,$date,$status,$user,$driver))->download('booking.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
    }

}
