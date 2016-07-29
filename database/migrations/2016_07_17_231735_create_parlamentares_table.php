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
            $table->string('cpf')->unique();
            $table->string('email')->unique();
            $table->string('telefone');
            $table->integer('tipo'); // EMPOSSADO / CANDIDATO
            $table->integer('numero_eleitoral')->unique();
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
