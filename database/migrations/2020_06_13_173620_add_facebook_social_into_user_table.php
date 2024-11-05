<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFacebookSocialIntoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            
            $table->text('facebook_id')->nullable()->after('profile_image');
            $table->text('facebook_token')->nullable()->after('facebook_id');
            $table->boolean('is_facebook_verified')->default(0)->comment('1:yes, 0:no')->after('facebook_token');

            $table->text('google_id')->nullable()->after('is_facebook_verified');
            $table->text('google_token')->nullable()->after('google_id');
            $table->boolean('is_google_verified')->default(0)->comment('1:yes, 0:no')->after('google_token');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            
            $table->dropColumn('facebook_id');
            $table->dropColumn('facebook_token');
            $table->dropColumn('is_facebook_verified');

            $table->dropColumn('apple_id');
            $table->dropColumn('apple_token');
            $table->dropColumn('is_apple_verified');
        });
    }
}
