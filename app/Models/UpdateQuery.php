<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Mail;

use App\Mail\ContactMail;



class UpdateQuery extends Model

{

    use HasFactory, SoftDeletes;



    protected $guarded=[];
    
    protected $table='update_query';



    public static function status(){

        return ['Pending', 'Resolved', 'In progress', 'Spam'];

    }



    public static function boot() {



        parent::boot();



        static::created(function ($item) {



            $adminEmail = "shubhneet_mishra@rvtechnologies.com";

            Mail::to($adminEmail)->send(new ContactMail($item));



        });



    }

}

