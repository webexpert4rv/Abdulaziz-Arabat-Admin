<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Job extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'transporter_id',                             
        'job_ID',                             
        'title',
        'vehicle_type_id',
        'number_of_vehicle',
        'same_receiver',       
        'schedule_date',
        'schedule_time',
        'total_goods_weight',
        'description_of_goods', 
        'requirements',
        'number_of_items',
        'product_id',
        'pick_up_region_id',
        'pick_up_sub_region_id',
        'pick_up_address',
        'pick_up_lat',
        'pick_up_long',
        'is_active_date',
        'status',
        'is_active',
        'rfq_status',
        'cancel_at',
        'delivery_date_time',
        'cancelled_by',
        'other',
        'created_by'
        
         
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function requestQuotes()
    {
        return $this->hasOne(RequestQuotes::class);
    } 


    public function receiveQuote()
    {
        return $this->hasOne(ReceiveQuotes::class);
    } 

    public function receiveQuotes()
    {
        return $this->hasmany(ReceiveQuotes::class)->with('user','driver')->orderBy('status','ASC');
    } 
    public function vehicleType()
    {

        return $this->belongsTo(VehicleType::class);
    } 

    public function PickupRegion()
    {

        return $this->belongsTo(Region::class,'pick_up_region_id','id');
    } 

    public function PickupSubRegion()
    {
        return $this->belongsTo(SubRegion::class,'pick_up_sub_region_id','id');
    } 

     public function booking(){

        return $this->hasMany(Booking::class);
    }    

    public function JobReceiver(){

        return $this->belongsTo(JobReceiver::class,'id','job_id')->with('DestinationRegion','DestinationSubRegion');
    }

   
    public function JobReceivers(){

        return $this->hasMany(JobReceiver::class,'job_id','id')->with('DestinationRegion','DestinationSubRegion');
    }
    public function product(){
        
        return $this->belongsTo(Product::class,'product_id','id');
    }
   
    public function scopeFiletr($query,$request)
    {
        $date_range = $request->date_range;
        if (isset($date_range[0])) {
            $query->whereDate('created_at','>=',date('Y-m-d',strtotime($date_range[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($date_range[1])));       
        } 

        if ($request->job_status) {
            $query->where('status',$request->job_status);
        }

        return $query;
    }

     public function scopeisExpired($query)
    {

        return $query->where('is_active_date','>=',Carbon::now()); 
       
    }


     public function reqQuotes()
    {
        return $this->hasMany(RequestQuotes::class);
    } 

  





}
