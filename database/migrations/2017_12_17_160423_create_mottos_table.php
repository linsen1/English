<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMottosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mottos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('chineseWord');
            $table->string('englishWord');
            $table->string('pic');
            $table->string('xiaobian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mottos');
    }
}
