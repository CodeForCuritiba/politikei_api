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
        DB::statement("Create View totalvotos as
                        Select
                            vu.user_id,
                            vp.proposicao_id,
                            vp.parlamentar_id,
                            if(vp.voto = 0, 1, 0) as nao,
                            if(vp.voto = 1, 1, 0) as sim,
                            if(vp.voto = 2, 1, 0) as naosei,
                            if(vp.voto = vu.voto, 1, 0) as usermatch
                        From
                            votos_parlamentares vp
                        Inner Join votos_users vu ON vp.proposicao_id = vu.proposicao_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view totalvotos");
    }
}
