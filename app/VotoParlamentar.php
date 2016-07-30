<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VotoParlamentar extends Model
{
    public $timestamps  = false;
    protected $fillable = ['parlamentar_id', 'proposicao_id', 'voto'];
}
