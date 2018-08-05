<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymbolSentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbol_sentences', function (Blueprint $table) {
            $table->increments('id')->comment("主键");
            $table->integer("symbol_id")->comment("关联音标主键");
            $table->string("ENSentence")->comment("句子");
            $table->string("CNSentence")->comment("句子释义");
            $table->string("SentenceMp3")->comment("句子音频");
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
        Schema::dropIfExists('symbol_sentences');
    }
}
