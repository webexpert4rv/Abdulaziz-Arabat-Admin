<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ReceiveQuotes extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',   
        'driver_id',     
        'job_id',   
        'quote_amount',   
        'status',     
        'comment',     
        'reasons', 
        'data', 
        'is_accepted',    
        'cancel_at',     
        'is_active_date',     
    ]; 


   
    public function scopeisExpired($query)
    {

        return $query->where('is_active_date','>=',Carbon::now()); 
       
    }


    public function driver()
    {
        return $this->belongsTo(User::class,'driver_id','id')->with('vehicleDetails','driverDetails')->withAvg('reviews','rating');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function job()
    {
        return $this->belongsTo(Job::class);
    } 



    
}
