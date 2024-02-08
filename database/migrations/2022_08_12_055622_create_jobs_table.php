<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();                         
            $table->string('job_ID')->nullable();
            $table->string('title')->nullable();
            $table->string('vehicle_type_id')->nullable();
            $table->string('number_of_vehicle')->nullable();
            $table->enum('same_receiver',['yes','no'])->nullable();
            $table->string('schedule_date')->nullable();
            $table->string('schedule_time')->nullable();
            $table->string('total_goods_weight')->nullable();
            $table->longtext('description_of_goods')->nullable();           
            $table->longtext('requirements')->nullable();           
            $table->string('number_of_items')->nullable();
            $table->foreignId('product_id')->constrained(); 
            $table->biginteger('pick_up_region_id')->nullable();
            $table->biginteger('pick_up_sub_region_id')->nullable();
            $table->string('pick_up_address')->nullable();
            $table->string('pick_up_lat')->nullable();
            $table->string('pick_up_long')->nullable(); 
            $table->text('other')->nullable(); 
            $table->timestamp('is_active_date')->nullable();            
            $table->enum('status',['pending','in-progress','cancelled','completed'])->default('pending');
            $table->enum('is_active',[0,1])->default(1)->comment('1=>active,0=>closed');
            $table->enum('rfq_status',[0,1])->default(0);
            $table->timestamp('delivery_date_time')->nullable();
            $table->enum('cancelled_by',['user','driver','transporter'])->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
