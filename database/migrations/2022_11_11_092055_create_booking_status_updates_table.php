<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingStatusUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_status_updates', function (Blueprint $table) {
            $table->id();
            $table->biginteger('booking_id')->nullable();
            $table->biginteger('driver_id')->nullable();
            $table->enum('status',['pending', 'not_started_yet','started','transporter_at_pick_up_location','goods_picked_up','on_the_way','arrived_at_destination','delivered','service_completed','cancelled','completed'])->default('pending');
           
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_status_updates');
    }
}
