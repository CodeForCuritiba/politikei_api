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
            $table->integer('parlamentar_id');
            $table->integer('categoria_id');
            $table->string('ementa');
            $table->longText('resumo');
            $table->string('nome');
            $table->integer('camara_id');
            $table->integer('situacao');
            $table->string('descricao');
            $table->integer('colaborador_id');
            $table->string('tipo');
            $table->string('tema');
            $table->string('autor');
            $table->date('data_apresentacao');
            $table->string('regime_tramitacao');
            $table->string('apreciacao');
            $table->string('situacao_camara');
            $table->longText('xml');
            $table->longText('explicacao_ementa');
            $table->string('link');
            $table->string('tipo_descricao');
            $table->integer('numero');
            $table->integer('ano');
            $table->string('autor_uf');
            $table->string('autor_partido');
            $table->integer('autor_camara_id');
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
