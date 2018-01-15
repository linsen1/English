<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('video_title');
            $table->string('video_poster');
            $table->string('video_SDdataSize');
            $table->string('video_HDdataSize');
            $table->string('video_FHDdataSize');
            $table->string('video_SDURL');
            $table->string('video_HDURL');
            $table->string('video_FHDURL');
            $table->longText('video_introduce');
            $table->string('video_dialog_bg');
            $table->longText('video_dialog_english');
            $table->longText('video_dialog_chinese');
            $table->longText('video_goldenSentence');
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
        Schema::dropIfExists('videos');
    }
}
