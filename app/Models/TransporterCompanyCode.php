<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransporterCompanyCode extends Model
{
    use HasFactory;

    protected $fillable=[
            'company_code',
            'status'
    ];
}
