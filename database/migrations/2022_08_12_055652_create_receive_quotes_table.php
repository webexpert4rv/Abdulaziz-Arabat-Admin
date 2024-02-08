<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiveQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive_quotes', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('user_id')->constrained();  
            $table->biginteger('driver_id')->nullable()->comment('driver_id =>is pointing to users.id');            
            $table->foreignId('job_id')->constrained();  
            $table->double('quote_amount',15,2)->unsigned()->default(0);
            $table->enum('status',['pending','cancelled','accepted','payment-pending','delivered','rejected','not accepted'])->default('pending');
            $table->enum('approved_by_admin',['yes','no'])->default('no');
            $table->string('is_accepted')->default(1)->comment('0=pending');
            $table->string('reasons')->nullable();
            $table->string('comment')->nullable();
            $table->longText('data')->nullable();
            $table->timestamp('is_active_date')->nullable();
            $table->timestamp('cancel_at')->nullable();
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
        Schema::dropIfExists('receive_quotes');
    }
}
