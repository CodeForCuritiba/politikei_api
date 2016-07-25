<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParlamentaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parlamentares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->string('estado', 2);
            $table->string('partido_sigla', 8);
            $table->string('avatar_url');
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
        Schema::drop('parlamentares');
    }
}
