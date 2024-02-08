<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'booked_on',
        'driver_id', 
        'user_id',
        'job_id',
        'quote_id',
        'transporter_name',
        'quote_amount',
        'discount',
        'tax_price',
        'penaltiy_amount',        
        'booking_fee',
        'date_of_service',
        'time_of_service',
        'vehicle_name',
        'vehicle_make',
        'vehicle_colour',
        'license_plate',
        'mobile_number',
        'pick_up_region_id',
        'pick_up_sub_region_id',
        'pick_up_latitude',
        'pick_up_longitude',
        'destination_region_id',
        'destination_sub_region_id',
        'destination_latitude',
        'destination_longitude',           
        'payment_status',
        'status',   
        'tracking_id',   
        'invoice_no',   
        'cancelled_by',   
        'cancel_at',
        'completeds_at',

    ];

    public function scopeFiletr($query,$request)
    {
        $date_range = $request->date_range;
        if (isset($date_range[0])) {

            $query->whereDate('booked_on','>=',date('Y-m-d',strtotime($date_range[0])))->whereDate('booked_on','<=',date('Y-m-d',strtotime($date_range[1])));       

        } 

        if ($request->booking_status) {

            $query->where('status',$request->booking_status);
        }

        if ($request->driver_name) {

            $query->where('driver_id',$request->driver_name);
        }
        if ($request->user_name) {

            $query->where('user_id',$request->user_name);
        }

        return $query;
    }


    public function driver()
    {
        return $this->belongsTo(User::class)->withAvg('reviews','rating');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function pickupRegion()
    {
        return $this->belongsTo(Region::class,'pick_up_region_id','id');
    }

    public function pickupSubRegion()
    {
        return $this->belongsTo(SubRegion::class,'pick_up_sub_region_id','id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }




}
