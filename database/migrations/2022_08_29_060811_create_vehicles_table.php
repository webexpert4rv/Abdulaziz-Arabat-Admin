<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id(); 
            $table->string('image')->nullable();
            $table->biginteger('driver_id')->nullable()->comment('driver_id = id from user table');
            $table->biginteger('transporter_id')->nullable()->comment('transporter_id = id from user table');
            $table->string('vehicle_registration')->nullable();
            $table->string('drivers_ID_or_iqama_number')->nullable(); 
            $table->string('Vehicle_PTA_License')->nullable(); 
            $table->string('insurance')->nullable(); 
            $table->foreignId('insurance_type_id')->constrained();   
            $table->date('insurance_expiry_date')->nullable();             
            $table->string('license_plate')->nullable();
            $table->foreignId('vehicle_type_id')->constrained();          
            $table->biginteger('preferred_location_for_delivery')->nullable()->comment('id from preferred_locations table'); 
            $table->string('vehicle_registration_year')->nullable();   
            $table->softDeletes();
            $table->enum('status',[0,1])->default(1)->comment('1=>active,0=>closed');             
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
        Schema::dropIfExists('transporter_vehicles');
    }
}
