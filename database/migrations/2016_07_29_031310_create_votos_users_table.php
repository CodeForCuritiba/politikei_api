<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotosUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votos_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();;
            $table->integer('proposicao_id')->unsigned();;
            $table->string('voto', 20);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('votos_users');
    }
}
