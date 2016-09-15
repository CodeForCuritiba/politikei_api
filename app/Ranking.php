<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    public $timestamps  = false;
    protected $fillable = [
                            'user_id',
                            'parlamentar_id',
                            'nome',
                            'email',
                            'numero_eleitoral',
                            'partido_sigla',
                            'avatar_url',
                            'coligacao',
                            'link_perfil',
                            'total_votos_usuario',
                            'igual',
                            'diferente',
                            'indiferente'
                          ];
}
