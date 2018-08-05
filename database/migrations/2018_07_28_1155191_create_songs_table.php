<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->increments('id')->comment("主键");
            $table->integer("ref_id")->comment("关联主键");
            $table->integer("type")->comment("类型，0音标");
            $table->string("songName")->comment("音乐名称");
            $table->string("songImgSmall")->comment("音乐缩略图");
            $table->string("songImgBig")->comment("音乐大图");
            $table->string("songMp3")->comment("一般品质");
            $table->string("songMp3HD")->comment("高清品质");
            $table->string("singer")->comment("歌手名称");
            $table->string("singerImg")->comment("歌手图片");
            $table->string("singerabout",3000)->comment("歌手简介");
            $table->string("songAbout",3000)->comment("音乐简介");
            $table->string("ENSong",3000)->comment("歌词");
            $table->string("CNSong",3000)->comment("中文歌词");
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
        Schema::dropIfExists('songs');
    }
}
