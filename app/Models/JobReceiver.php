<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobReceiver extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_id',  
        'job_id',  
        'driver_id',  
        'receivers_name',  
        'receiver_number',  
        'destination_region_id',  
        'destination_sub_region_id',  
        'destination_address',  
        'destination_lat',  
        'destination_long',  
        'verification_code',  
        'status',  
        'delivery_date_time',  
        'receive_status',  
    ];



    protected $appends = ['profile_image'];
 
    public function getProfileImageAttribute(){
        
        return "storage/user_profile.jpg";
    }



    public function DestinationRegion()
    {

        return $this->belongsTo(Region::class,'destination_region_id','id');
    } 

    public function DestinationSubRegion()
    {
        return $this->belongsTo(SubRegion::class,'destination_sub_region_id','id');
    } 

     public function JobDeliveredStatus()
    {

        return $this->hasone(JobDeliveredStatus::class);
    }


    public function DestinationAddres()
    {
        return $this->hasone(SubRegion::class,'id','destination_sub_region_id');
    }
  
}
