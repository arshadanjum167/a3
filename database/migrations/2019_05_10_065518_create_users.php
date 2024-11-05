<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('country_code', 5)->nullable();
            $table->string('contact_number', 10)->nullable();
            $table->string('password', 255)->nullable();
            $table->text('profile_image')->nullable();
            
            $table->tinyInteger('actor')->default(3)->comment('1:Admin,2:Subadmin,3:User');
            $table->boolean('is_email_verified')->default(0)->comment('1:yes, 0:no');
            $table->string('email_verification_token', 255)->nullable();
            $table->dateTime('email_verification_token_timeout')->nullable();
            $table->string('forgot_password_token', 255)->nullable();
            $table->dateTime('forgot_password_token_timeout')->nullable();
            $table->boolean('is_active')->default(1)->comment('1:active, 0:inactive');
            $table->boolean('is_deleted')->default(0)->comment('1:yes, 0:no');
            $table->bigInteger('i_by')->nullable();
            $table->dateTime('i_date')->nullable();
            $table->bigInteger('u_by')->nullable();
            $table->dateTime('u_date')->nullable();
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
