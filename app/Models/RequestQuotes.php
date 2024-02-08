<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestQuotes extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',   
        'job_id',   
        'driver_id',     
        'status', 
        'pending_rfq', 
        'is_payment', 
        'is_quotes_post', 
        'is_active_date', 
        'admin_assignjob_to_transporter', 
            
    ]; 
    public function job(){
        return $this->belongsTo(Job::class,'job_id','id')->with('PickupRegion','PickupSubRegion','JobReceiver');
    }

    public function user(){

        return $this->belongsTo(User::class,'user_id','id');
    }
    public function driver(){

        return $this->belongsTo(User::class,'driver_id','id');
    }
}
