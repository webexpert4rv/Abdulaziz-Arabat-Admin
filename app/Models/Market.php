<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Market extends Model
{
    use HasFactory;
    protected $table = 'market';

    protected $fillable = [
        'heading',
        'text',                             
        'image',                             
       
        
         
    ];


   

}
