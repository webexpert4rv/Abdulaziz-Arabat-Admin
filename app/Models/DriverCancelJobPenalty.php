<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverCancelJobPenalty extends Model
{
    use HasFactory;

     protected $fillable=[
        'driver_id',        
        'job_id',
        'penaltiy_amount',
        'status',
    ];
}
