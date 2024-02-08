<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;
    protected $fillable=[
        'tax',
        'commission',
        'penality',
        'base_fee',
        'online_payment_discount',
    ];
    
}
