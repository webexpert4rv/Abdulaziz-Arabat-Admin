<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCancelJobPenalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cancel_job_penalities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->contrained();
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
        Schema::dropIfExists('user_cancel_job_penalities');
    }
}
