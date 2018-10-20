<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('storyTitle')->comment("故事标题")->nullable();
            $table->integer("storyClassID")->comment("分类")->nullabel();
            $table->string("storyAbout")->comment("故事引导");
            $table->string("storyImg")->comment("故事主图");
            $table->string("storyAudio")->comment("故事音频");
            $table->text("storyEN")->comment("英文内容");
            $table->text("storyCN")->comment("中文内容");
            $table->text("storyENCN")->comment("中英文混排");
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
        Schema::dropIfExists('stories');
    }
}
