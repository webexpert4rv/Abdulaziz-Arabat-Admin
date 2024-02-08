<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained();             
            $table->foreignId('job_id')->constrained();             
            $table->foreignId('user_id')->constrained();             
            $table->biginteger('driver_id')->nullable();             
            $table->string('transaction_id')->nullable();             
            $table->string('booked_on')->nullable();             
            $table->string('amount')->nullable();             
            $table->string('status')->nullable();             
            $table->string('approved')->nullable();   
            $table->string('customer')->nullable();   
            $table->string('customer_email')->nullable();   
            $table->text('response')->nullable(); 
            $table->biginteger('bank_account_id')->nullable();    
            $table->text('bank_name')->nullable();             
            $table->text('account_info')->nullable();             
            $table->string('bank_rceipt')->nullable();             
            $table->string('remitter_name')->nullable();             
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
        Schema::dropIfExists('transactions');
    }
}
