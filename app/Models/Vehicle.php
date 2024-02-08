<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
 
    use HasFactory,SoftDeletes;

    protected $fillable = 
    [
        'driver_id',
        'transporter_id',
        'vehicle_registration',
        'drivers_ID_or_iqama_number',
        'Vehicle_PTA_License',
        'driver_license_of_transporter',
        'insurance',
        'insurance_type_id',
        'insurance_expiry_date',
        'vehicle_name',
        'Vehicle_colour',
        'license_plate',
        'vehicle_type_id',
        'preferred_location_for_delivery',
        'professional_information',
        'verification_id',
        'company_name',
        'date_of_service',
        'vehicle_registration_year',
        'status',
    ];

     public function vehicleType()
    {

        return $this->belongsTo(VehicleType::class);
    } 

    public function driver()
    {

        return $this->belongsTo(User::class);
    }
    
    public function preferredLocation()
    {

        return $this->belongsTo(SubRegion::class,'preferred_location_for_delivery','id');
    }
    public function insuranceType()
    {

        return $this->belongsTo(InsuranceType::class,'insurance_type_id','id');
    }
    
}

