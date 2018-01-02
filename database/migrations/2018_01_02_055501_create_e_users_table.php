<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openId');
            $table->string('nickName');
            $table->integer('gender');
            $table->string('language');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('avatarUrl');
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
        Schema::dropIfExists('e_users');
    }
}
