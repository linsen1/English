<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymbolsTable extends Migration
{
    /**
     * Run the migrations.
     * 创建音标基础表
     * @return void
     */
    public function up()
    {
        Schema::create('symbols', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string("title")->comment('音标名');
            $table->integer("type")->comment("0 前元音 1 中元音 2 后元音  3 辅音（摩擦音）4 辅音");
            $table->integer("orderflag")->comment("顺序");
            $table->boolean("typeflag")->comment("分类标识");
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
        Schema::dropIfExists('symbols');
    }
}
