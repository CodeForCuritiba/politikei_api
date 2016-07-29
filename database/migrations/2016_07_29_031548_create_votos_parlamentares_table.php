<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotosParlamentaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votos_parlamentares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parlamentar_id')->unsigned();;
            $table->integer('proposicao_id')->unsigned();;
            $table->string('voto', 20);
            $table->timestamps();

            $table->foreign('parlamentar_id')->references('id')->on('parlamentares');
            $table->foreign('proposicao_id')->references('id')->on('proposicoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('votos_parlamentares');
    }
}
