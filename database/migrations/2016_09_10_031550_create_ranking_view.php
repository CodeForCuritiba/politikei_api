<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("Create View Ranking as
                        Select
                            v.user_id,
                            p.id as parlamentar_id,
                            p.nome as parlamentar_nome,
                            p.partido_sigla,
                            Sum(v.UserMatch) as QtdeProposicoes,
                            ROUND((Sum(v.Sim)/Count(Distinct v.proposicao_id))*100,2) as sim,
                            ROUND((Sum(v.Nao)/Count(Distinct v.proposicao_id))*100,2) as nao,
                            ROUND((Sum(v.NaoSei)/Count(Distinct v.proposicao_id))*100,2) as naosei
                        From
                            parlamentares p
                                Inner Join TotalVotos v
                                    on p.id = v.parlamentar_id
                        Group by
                            v.User_id,
                            p.nome,
                            p.partido_sigla
                        Order by
                            Sum(v.UserMatch) desc, p.nome asc
                        Limit 20");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW Ranking");
    }
}
