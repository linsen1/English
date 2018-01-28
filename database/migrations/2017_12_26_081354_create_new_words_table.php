<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_words', function (Blueprint $table) {
            $table->increments('id');
            $table->string('word');
            $table->string('yinbiao');//英式发音
            $table->string('yinbiaoMp3');
            $table->string('yinbiao1');//美式发音
            $table->string('yinbiao1Mp3');
            $table->string('chinese');
            $table->integer('mottoId');
            $table->integer('type');
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
        Schema::dropIfExists('new_words');
    }
}
