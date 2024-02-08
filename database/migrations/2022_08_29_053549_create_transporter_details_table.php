<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransporterDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transporter_details', function (Blueprint $table) {
            $table->id();
            $table->biginteger('driver_id')->nullable()->comment('driver_id = id from user table');
            $table->biginteger('transporter_id')->nullable()->comment('transporter_id = id from user table');
            $table->string('vehicle_owner_name')->nullable(); 
            $table->string('company_code')->nullable(); 
            $table->string('public_transport_authority_license')->nullable(); 
            $table->string('pta_license_number')->nullable(); 
            $table->string('commercial_registration')->nullable(); 
            $table->string('vat_registration')->nullable(); 
            $table->string('iban_details')->nullable(); 
            $table->string('name_transporter_supervisor')->nullable(); 
            $table->string('country_code')->nullable(); 
            $table->string('supervisor_phone_number')->nullable(); 
            $table->string('driver_licence')->nullable(); 
            $table->string('verification_id')->nullable(); 
            $table->text('description')->nullable();
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
        Schema::dropIfExists('transporter_details');
    }
}
