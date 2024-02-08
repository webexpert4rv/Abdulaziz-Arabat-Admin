<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingStatusUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'driver_id',
        'status',
    ];


     
    /*public function scopeWhereStatus($query)
    {
         return $query->where('status','delivered');
    }*/



}
