<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();  
            $table->foreignId('promo_code_id')->constrained(); 
            $table->foreignId('receive_quote_id')->constrained();
            $table->tinyInteger('coupon_apply_status')->comment('1=applied 0=not applied');
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
        Schema::dropIfExists('apply_coupons');
    }
}
