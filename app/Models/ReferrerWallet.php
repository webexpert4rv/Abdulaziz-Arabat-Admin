<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferrerWallet extends Model
{
    use HasFactory;


    protected $fillable = [                
        'user_id',          
        'earn',          
        'spend',   
    ];
}
