<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    public $timestamps  = false;
    protected $fillable = ['user_id',
                            'parlamentar_id',
                            'parlamentar_nome',
                            'partido_sigla',
                            'QtdeProposicoes',
                            'Sim',
                            'Nao',
                            'NaoSei'
                          ];
}
