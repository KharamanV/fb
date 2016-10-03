<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->integer('tag_id')->unsigned()->index();
        });

        Schema::table('tag_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tag_user', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['tag_id']);
        });
        Schema::dropIfExists('tag_user');
    }
}
