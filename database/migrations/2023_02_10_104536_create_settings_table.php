<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('radius')->nullable();
            $table->enum('show_referel', ['1', '2'])->default('2')->comment('1 for Yes, 2 for No');
            $table->enum('show_promotion', ['1', '2'])->default('2')->comment('1 for Yes, 2 for No');
            $table->tinyInteger('rfq_limit_for_driver',20)->unsigned()->nullable();
            $table->tinyInteger('rfq_limit_for_user',20)->unsigned()->nullable();
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
        Schema::dropIfExists('settings');
    }
}
