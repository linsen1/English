<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomebannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homebanners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imgurl')->comment("大图");
            $table->integer('type')->comment('0:站内公告 1：名句 2:美文 3:影视 4:歌曲');
            $table->integer("ref_id")->comment("类型主键");
            $table->string("title")->comment('标题');
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
        Schema::dropIfExists('homebanners');
    }
}
