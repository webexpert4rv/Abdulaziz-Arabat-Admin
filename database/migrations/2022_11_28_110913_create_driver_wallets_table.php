<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_wallets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transporter_id')->comment('transporter_id used from id of user table')->nullable();
            $table->bigInteger('driver_id')->commment('driver_id used from id of user table')->nullable();
            $table->double('amount',10,2)->nullable(); 
            $table->double('transporter_commission',10,2)->default(0);
            $table->double('penalty_amount',10,2)->default(0);
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
        Schema::dropIfExists('driver_wallets');
    }
}
