<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable=[
        'booking_id',             
        'job_id',             
        'user_id',             
        'driver_id',             
        'transaction_id',             
        'booked_on',             
        'amount',             
        'status',             
        'approved',   
        'customer',   
        'customer_email',   
        'response',
        'bank_account_id',
        'bank_name',
        'account_info',
        'bank_rceipt',
        'remitter_name',
    ]; 

    public function driver(){
        return $this->belongsTo(User::class,'driver_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function booking(){

        return $this->belongsTo(Booking::class);
    }
    public function job(){

        return $this->belongsTo(Job::class);
    }

    public function scopereportFilter($query,$request)
	{
		$year=$request->year;
		$month=$request->month;
		//->whereYear('created_at',$year)
		//->whereMonth('created_at',$month)
		if(!empty($year)){
			$query->whereYear('created_at',$year);
		}
		if(!empty($month)){
			$query->whereMonth('created_at',$month);
		}
		return $query;
	}
   

}
