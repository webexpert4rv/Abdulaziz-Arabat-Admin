<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('book_id')->nullable();
            $table->timestamp('booked_on')->nullable(); 
            $table->string('driver_id')->nullable(); 
            $table->foreignId('user_id')->constrained();
            $table->foreignId('job_id')->constrained();
            $table->biginteger('quote_id')->nullable();
            $table->string('transporter_name')->nullable();
            $table->string('quote_amount')->nullable();
            $table->string('discount')->nullable();
            $table->string('tax_price')->nullable();
            $table->string('penaltiy_amount')->nullable();
            $table->string('booking_fee')->nullable();
            $table->string('date_of_service')->nullable();
            $table->string('time_of_service')->nullable();
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('vehicle_colour')->nullable();
            $table->string('license_plate')->nullable();
            $table->string('mobile_number')->nullable();
            $table->biginteger('pick_up_region_id')->nullable();
            $table->biginteger('pick_up_sub_region_id')->nullable();
            $table->string('pick_up_latitude')->nullable();
            $table->string('pick_up_longitude')->nullable(); 
            $table->enum('payment_status',['pending','success','failed'])->default('pending');            
            $table->enum('status',['not_started_yet','started','transporter_at_pick_up_location','goods_picked_up','on_the_way','arrived_at_destination','delivered','service_completed','cancelled'])->default('not_started_yet');   
            $table->string('tracking_id')->nullable(); 
            $table->string('invoice_no')->nullable(); 
            $table->enum('cancelled_by',['user','driver','transporter'])->nullable();  
            $table->timestamp('cancel_at')->nullable();
            $table->timestamp('completeds_at')->nullable();
            $table->timestamps();
        });
    }








    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
