<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unique_ID')->nullable();
            $table->foreignId('role_id')->constrained();
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('country_code')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('password');
            $table->string('profile_image')->nullable();
            $table->text('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('email_verified_token')->nullable();
            $table->enum('is_email_verified',['0','1'])->default('0');
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('is_phone_verified',['0','1'])->default('0');
            $table->string('ip_address')->nullable();
            $table->string('device_token')->nullable();
            $table->enum('token_type',['web','ios','android']);
            $table->enum('user_locked',['0','1'])->default('0');
            $table->enum('privacy_policy',['0','1'])->default('0');
            $table->timestamp('user_locked_at')->nullable();
            $table->string('login_with')->nullable();
            $table->string('socketid')->nullable();
            $table->timestamp('last_logged_in_at')->nullable();
            $table->string('is_deleted')->nullable();
            $table->enum('is_push_notifications',['0','1'])->default('1');
            $table->enum('is_email_notifications',['0','1'])->default('1');
            $table->enum('status',['0','1'])->default('1'); 
            $table->enum('login_status',['0','1'])->default('0'); 
            $table->enum('is_online',['0','1'])->default('0')->comment('1=online , 0=offline');
            $table->tinyInteger('is_approve')->default(0)->comment('1=Approve , 0=Unapprove');
            $table->enum('account_type',['0','1','2','3','4'])->default('0')->comment('0=User Personal 1=User Business 2=Transporter Personal 3=Transporter Business 4= driver'); $table->enum('created_by',['Admin','Transporter','Self'])->nullable();
            $table->biginteger('parent_id')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
