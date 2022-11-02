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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->float('amount');
            $table->date('due_date')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('advert_id');
            $table->timestamp('accepted')->nullable();
            $table->timestamp('rejected')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('advert_id')->references('id')->on('adverts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign('offers_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('offers_advert_id_foreign');
            $table->dropColumn('advert_id');
        });

        Schema::dropIfExists('offers');
    }
};
