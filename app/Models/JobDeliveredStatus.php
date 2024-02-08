<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDeliveredStatus extends Model
{
    use HasFactory;

     protected $fillable=[
        'job_id',
        'job_receiver_id',
        'driver_id',
        'receive_status',
        'delivery_date_time',
    ];
}
