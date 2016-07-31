<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposicao extends Model
{
    protected $table = 'proposicoes';
    public $timestamps = false;
    protected $fillable = ['id', 'nome', 'descricao', 'resumo', 'ementa', 'categoria',
        'camara', 'situacao', 'autor', 'parlamentar', 'parlamentar_partido', 'data_apresentacao',
        'data_conclusao', 'regime_tramitacao', 'apreciacao', 'explicacao_ementa','link','numero','ano'];

    public function votos()
    {
        return $this->hasMany('App\Voto');
    }

    public function parlamentar()
    {
        return $this->belongsTo('App\Parlamentar');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
