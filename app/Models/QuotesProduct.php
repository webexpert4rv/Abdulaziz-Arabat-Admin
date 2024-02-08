<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotesProduct extends Model
{
    use HasFactory;

     protected $fillable = [
        'job_id',   
        'product_id',     
    ]; 
}
