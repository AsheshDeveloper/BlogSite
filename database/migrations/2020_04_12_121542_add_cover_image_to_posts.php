<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoverImageToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // up created our custom fields in the table
        Schema::table('posts', function (Blueprint $table) {
            //add cover images in posts table
            $table->string('cover_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // whereas down reverts the changes/ roll back function
        Schema::table('posts', function (Blueprint $table) {
            //add user_id in posts table
            $table->dropColumn('cover_image');
        });
    }
}
