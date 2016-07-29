<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposicoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('descricao');
            $table->longText('resumo');
            $table->string('ementa');
            $table->string('categoria');
            $table->string('camara');
            $table->string('situacao');
            $table->string('autor');
            $table->string('parlamentar');
            $table->string('parlamentar_partido', 8);
            $table->date('data_apresentacao');
            $table->date('data_conclusao');
            $table->string('regime_tramitacao');
            $table->string('apreciacao');
            $table->longText('explicacao_ementa');
            $table->string('link');
            $table->integer('numero');
            $table->integer('ano');
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
        Schema::drop('proposicoes');
    }
}
