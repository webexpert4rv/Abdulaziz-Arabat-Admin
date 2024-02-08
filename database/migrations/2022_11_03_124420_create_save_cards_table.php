<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaveCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->Constrained();
            $table->string('card_holder_name')->nullable();
            $table->string('card_number')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('is_default')->default(0)->comment('default payment card 1 otherwise 0')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=Inactive 1=Active')->nullable();
           
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
        Schema::dropIfExists('save_cards');
    }
}
