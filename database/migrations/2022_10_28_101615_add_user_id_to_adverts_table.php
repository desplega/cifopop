<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adverts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('image');
            $table->foreign('user_id')->references('id')->on('users');
        });

        // Note: Fill user_id with random users in phpMyAdmin (valid user IDs go from 1 to 6 included)
        // UPDATE table_name SET user_id = FLOOR( 1 + RAND( ) * 6 );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adverts', function (Blueprint $table) {
            $table->dropForeign('adverts_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
