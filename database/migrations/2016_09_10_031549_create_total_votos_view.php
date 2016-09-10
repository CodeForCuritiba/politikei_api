<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotalVotosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("Create View TotalVotos as
                        SELECT
                            vu.User_id,
                            vp.proposicao_id,
                            vp.parlamentar_id,
                            if(vp.voto = 0, 1, 0) AS Nao,
                            if(vp.voto = 1, 1, 0) AS Sim,
                            if(vp.voto = 2, 1, 0) AS NaoSei,
                            if(vp.voto = vu.voto, 1, 0) as UserMatch
                        FROM
                            Votos_Parlamentares vp
                        INNER JOIN votos_users vu ON vp.proposicao_id = vu.proposicao_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW TotalVotos");
    }
}
