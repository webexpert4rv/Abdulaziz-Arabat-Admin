<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DriverWallet extends Model
{
    use HasFactory;


    protected $fillable = [
        'transporter_id',
        'driver_id',
        'amount',
        'transporter_commission',
        'penalty_amount',
        'paid_date'
    ];



    public function scopeFilter($query, $request)
    {

        if ($request->filter==1) {

            return $query->whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                       
        }
        if ($request->filter==2) {

            return $query->whereMonth('created_at', Carbon::now()->month);
            
        }
        if ($request->filter==3) {

            return $query->whereYear('created_at', Carbon::now()->year);
            
        }


    }


}
