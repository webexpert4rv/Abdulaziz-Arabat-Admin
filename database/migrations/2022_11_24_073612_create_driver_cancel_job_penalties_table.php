<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverCancelJobPenaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_cancel_job_penalties', function (Blueprint $table) {
            $table->id();
            $table->integer('driver_id')->nullable();
            $table->foreignId('job_id')->contrained();
            $table->double('penaltiy_amount',10,2);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('driver_cancel_job_penalties');
    }
}
