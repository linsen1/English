<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymbolContentsTable extends Migration
{
    /**
     * Run the migrations.
     * 音标基础内容表
     * @return void
     */
    public function up()
    {
        Schema::create('symbol_contents', function (Blueprint $table) {
            $table->increments('id')->comment("主键");
            $table->integer("symbol_id")->comment("音标主表关联表");
            $table->string("speakVideo")->comment("视频URL");
            $table->string("speakImgUrl")->comment("发音背景图片");
            $table->string("speakAbout",2000)->comment("发音文字介绍");
            $table->string("speakWord")->comment("发音代言词");
            $table->string("speakWordImg")->comment("音标代言词图片");
            $table->string("speakWordMp3")->comment("音标代言词音频");
            $table->string("speakWordChinese")->comment("音标代言词释义");
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
        Schema::dropIfExists('symbol_contents');
    }
}
