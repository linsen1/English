<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymbolWordsgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbol_wordsgroups', function (Blueprint $table) {
            $table->increments('id')->comment("主键");
            $table->integer("symbol_id")->comment("音标关联主键");
            $table->string("wordGroup")->comment("字母组合");
            $table->string("Words")->comment("相关单词");
            $table->string("WordsMp3")->comment("组合发音");
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
        Schema::dropIfExists('symbol_wordsgroups');
    }
}
