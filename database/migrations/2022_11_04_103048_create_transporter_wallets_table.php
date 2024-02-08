<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransporterWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transporter_wallets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transporter_id')->comment('transporter_id used from id of user table')->nullable();
            $table->bigInteger('admin_id')->commment('admin_id used from id of admin table')->nullable();
            $table->double('amount',10,2)->nullable();
            $table->double('admin_commission',10,2)->default(0);
            $table->double('penalty_amount',10,2)->default(0);
            $table->date('paid_date')->nullable();
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
        Schema::dropIfExists('transporter_wallets');
    }
}
