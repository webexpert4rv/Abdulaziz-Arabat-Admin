<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransporterDetail extends Model
{
    use HasFactory;
   // protected $guarded=[];
    protected $fillable=[
            'driver_id',
            'transporter_id',
            'verification_id',
            'vehicle_owner_name', 
            'company_code',
            'public_transport_authority_license',
            'pta_license_number',
            'commercial_registration', 
            'vat_registration', 
            'iban_details', 
            'name_transporter_supervisor',
            'country_code', 
            'supervisor_phone_number',
            'description',
            'driver_licence',
    ];
}
