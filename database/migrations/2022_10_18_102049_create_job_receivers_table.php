<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_receivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); 
            $table->foreignId('job_id')->constrained();
            $table->integer('driver_id')->nullable();
            $table->string('receivers_name')->nullable();
            $table->string('receiver_number')->nullable();
            $table->biginteger('destination_region_id')->nullable();
            $table->biginteger('destination_sub_region_id')->nullable();
            $table->string('destination_address')->nullable();
            $table->string('destination_lat')->nullable();
            $table->string('destination_long')->nullable();
            $table->string('verification_code')->nullable();
            $table->enum('receive_status',['pending','delivered','Ongoing'])->default('pending');
            $table->string('status')->nullable();
            $table->timestamp('delivery_date_time')->nullable();
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
        Schema::dropIfExists('job_receivers');
    }
}
