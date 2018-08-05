<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymbolPhrasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbol_phrases', function (Blueprint $table) {
            $table->increments('id')->comment("主键");
            $table->integer("symbol_id")->comment("关联音标主表主键");
            $table->string("ENPhrase")->comment("短语");
            $table->string("CNPhrase")->comment("中文释义");
            $table->string("PhraseMp3")->comment("短语发音MP3");
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
        Schema::dropIfExists('symbol_phrases');
    }
}
