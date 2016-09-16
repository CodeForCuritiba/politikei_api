<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRankingViewGroupByUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::raw("
            Alter View ranking as
            Select
                v.user_id,
                p.id as parlamentar_id,
                p.nome,
                p.email,
                p.numero_eleitoral,
                p.partido_sigla,
                p.avatar_url,
                p.coligacao,
                p.link_perfil,
                count(distinct v.proposicao_id) as total_votos_usuario,
                Sum(v.igual) as igual,
                Sum(v.diferente) as diferente,
                Sum(v.indiferente) as indiferente,
                Sum(v.neutro) as neutro
            From
                parlamentares p
                Inner Join totalvotos v on p.id = v.parlamentar_id
            Group by
                p.id, v.user_id
            Order by
                igual desc, diferente asc, p.nome asc;
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
