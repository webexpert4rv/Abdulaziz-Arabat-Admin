<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobDeliveredStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_delivered_statuses', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('job_id')->constrained();
            $table->foreignId('job_receiver_id')->constrained();
            $table->integer('driver_id')->nullable();
            $table->enum('receive_status',['delivered'])->nullable();            
            $table->timestamp('delivery_date_time')->nullable();;
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
        Schema::dropIfExists('job_delivered_statuses');
    }
}
