<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobsPaymentDetails extends Model
{
 
    protected $table = 'jobsPaymentDetails';

    protected $fillable = [
        'job_id',
        'user_base_price',
        'user_tax',
        'user_commission',
        'user_language_code',
        'user_type',
        'transpoeter_base_price',
        'transpoeter_tax',
        'transpoeter_commission',
        'transpoeter_language_code',
        'transpoeter_type',
        
    ];
}
