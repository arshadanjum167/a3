<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('project_id')->nullable();
            $table->bigInteger('type')->default();//1=image
            $table->text('link')->nullable();
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
        Schema::dropIfExists('projects_media');
    }
}
