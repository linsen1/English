<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('EnWords')->comment('英语短语');
            $table->string('CnWords')->comment('中文');
            $table->string('EnMp3')->nullable()->comment('音频地址');
            $table->integer('type')->comment('类型 0 句子；1 影视；2 美文');;
            $table->integer('refID')->comment('相关文章、影视、句子');;
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
        Schema::dropIfExists('sentences');
    }
}
