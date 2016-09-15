<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRankingView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::raw("Alter View ranking as
			Select

				v.user_id,
				p.nome,
				p.partido_sigla,
				Count(Distinct v.proposicao_id) as QtdeProposicoes,
				ROUND((Sum(v.igual)/Count(Distinct v.proposicao_id))*100,2) as igual,
				ROUND((Sum(v.diferente)/Count(Distinct v.proposicao_id))*100,2) as diferente,
				ROUND((Sum(v.indiferente)/Count(Distinct v.proposicao_id))*100,2) as indiferente 
			From
				parlamentares p
					Inner Join totalvotos v
						on p.id = v.parlamentar_id

			Group by
				p.nome,
				p.partido_sigla

			Order by
				Sum(v.igual) desc, p.nome asc
                        Limit 20");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::raw("DROP VIEW Ranking");
    }
}
