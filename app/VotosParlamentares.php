<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VotosParlamentares extends Model
{
    public $timestamps  = false;
    protected $fillable = ['parlamentar_id', 'proposicao_id', 'voto'];
}
