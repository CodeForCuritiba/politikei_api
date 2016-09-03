<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
//use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$password =  Crypt::encrypt('secret');
        DB::table('proposicoes')->insert([
            'nome' => 'Lei 1',
            'descricao' => 'teste de lei', 
            'resumo' => 'teste de lei',
            'ementa' => 'ementa',
            'categoria' => 'categoria de teste',
            'camara' => 'Curiitba',
            'situacao' =>  'aprovada',
            'autor' =>  'Teste',
            'parlamentar' =>  'Murilo',
            'parlamentar_partido' => 'CODE',
            'explicacao_ementa' => 'explicacao explicada',
            'link' => '',
            'numero' => 1,
            'ano' => 2016
        ],
        [
            'nome' => 'Lei 2',
            'descricao' => 'teste de lei', 
            'resumo' => 'teste de lei',
            'ementa' => 'ementa',
            'categoria' => 'categoria de teste',
            'camara' => 'Curiitba',
            'situacao' =>  'aprovada',
            'autor' =>  'Teste',
            'parlamentar' =>  'Murilo',
            'parlamentar_partido' => 'CODE',
            'explicacao_ementa' => 'explicacao explicada',
            'link' => '',
            'numero' => 2,
            'ano' => 2016
        ],
        [
            'nome' => 'Lei 3',
            'descricao' => 'teste de lei', 
            'resumo' => 'teste de lei',
            'ementa' => 'ementa',
            'categoria' => 'categoria de teste',
            'camara' => 'Curiitba',
            'situacao' =>  'aprovada',
            'autor' =>  'Teste',
            'parlamentar' =>  'Murilo',
            'parlamentar_partido' => 'CODE',
            'explicacao_ementa' => 'explicacao explicada',
            'link' => '',
            'numero' => 3,
            'ano' => 2016
        ]);

        DB::table('parlamentares')->insert([
            'nome' => 'Douglas',
            'partido_sigla' => 'CWB',
            'avatar_url' => 'http://cicerocattani.com.br/wp-content/uploads/2015/03/jonny-Stica.jpg'
        ],
        [
            'nome' => 'Paula',
            'partido_sigla' => 'PDL',
            'avatar_url' => 'http://cicerocattani.com.br/wp-content/uploads/2015/03/jonny-Stica.jpg'
        ],
        [
            'nome' => 'Gustavo',
            'partido_sigla' => 'CODE',
            'avatar_url' => 'http://cicerocattani.com.br/wp-content/uploads/2015/03/jonny-Stica.jpg'
        ]);


    }
}
