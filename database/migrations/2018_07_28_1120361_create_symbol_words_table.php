<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymbolWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbol_words', function (Blueprint $table) {
            $table->increments('id')->comment("主键");
            $table->integer("symbol_id")->comment("单词关联音标主键");
            $table->string("ENword")->comment("单词");
            $table->string("CNword")->comment("中文释义");
            $table->string("wordSymbol")->comment("单词音标");
            $table->string("ENwordMp3")->comment("音标音频地址");
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
        Schema::dropIfExists('symbol_words');
    }
}
