<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceStatus extends Model
{
   use HasFactory;


   protected $fillable = [
      'slug',
      'name',
      'ar_name',
      'status' 
   ];

   protected $appends = ["display_name"];

   public function getDisplayNameAttribute() {

      if (Auth()->user()->language_code=='ar') {

         return  langCode($this->attributes['ar_name']);

      }else if (Auth()->user()->language_code=='ur') {

         return  langCode($this->attributes['ar_name']);

      }else{

         return  langCode($this->attributes['name']);
      }
   }



}
