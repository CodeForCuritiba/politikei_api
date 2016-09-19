<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterViewTotalvotosExcludeInativas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::raw("
                Alter View totalvotos as
                Select
                    vp.proposicao_id,
                    vp.parlamentar_id, vu.user_id,
                    if(((vu.voto <> 2) && (vp.voto <> 2) && (vp.voto = vu.voto)), 1, 0) as igual,
                    if(((vu.voto <> 2) && (vp.voto <> 2) && (vp.voto <> vu.voto)), 1, 0) as diferente,
                    if(((vu.voto <> 2) && (vp.voto = 2)), 1, 0) as indiferente,
                    if((vu.voto = 2), 1, 0) as neutro
                From
                    votos_parlamentares vp
                    Inner Join votos_users vu ON vp.proposicao_id = vu.proposicao_id
                    Inner Join proposicoes prop ON vp.proposicao_id = prop.id
                Where
                    prop.inativa = false;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
