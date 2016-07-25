<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposicao extends Model
{
    protected $table = 'proposicoes';
    public $timestamps = false;
    protected $fillable = ['id', 'tipo', 'codigo', 'parlamentar_id', 'categoria_id', 'ementa', 'resumo', 'nome', 'camara_id', 'situacao', 'descricao', 'colaborador_id'];

    public function votos()
    {
        return $this->hasMany('App\Models\Voto');
    }

    public function parlamentar()
    {
        return $this->belongsTo('App\Models\Parlamentar');
    }
}