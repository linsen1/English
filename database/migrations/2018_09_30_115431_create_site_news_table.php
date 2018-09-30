<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment("新闻标题");
            $table->text("contents")->comment("新闻内容");
            $table->string("bannerUrl")->comment("新闻图片");
            $table->integer("type")->default(0)->comment("新闻类型");;
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
        Schema::dropIfExists('site_news');
    }
}
