<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
                     
            $table->biginteger('sender_id')->nullable();             
            $table->biginteger('receiver_id')->nullable(); 
            $table->biginteger('action_id')->nullable();            
            $table->string('title')->nullable(); 
            $table->string('type')->nullable(); 
            $table->string('isRead')->nullable(); 
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
        Schema::dropIfExists('notifications');
    }
}
