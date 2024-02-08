<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();  
            $table->foreignId('job_id')->constrained(); 
            $table->biginteger('driver_id')->nullable()->comment('driver_id =>is pointing to users.id');  
            $table->timestamp('is_active_date')->nullable();
            $table->enum('status',['pending','cancelled','completed','quote_post','expired','accepted','closed'])->default('pending');
            $table->enum('pending_rfq',['0','1'])->default('1');
            $table->enum('is_payment',['0','1'])->default('1');
            $table->enum('is_quotes_post',['0','1'])->default('1');
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
        Schema::dropIfExists('request_quotes');
    }
}
