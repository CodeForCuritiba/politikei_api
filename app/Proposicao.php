<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Proposicao;

class Proposicao extends Model
{
    protected $table = 'proposicoes';
    public $timestamps = false;
    protected $fillable = ['id', 'nome', 'descricao', 'resumo', 'ementa', 'categoria',
        'camara', 'situacao', 'autor', 'parlamentar', 'parlamentar_partido', 'data_apresentacao',
        'data_conclusao', 'regime_tramitacao', 'apreciacao', 'explicacao_ementa','link','numero','ano'];

    public function votos()
    {
        return $this->hasMany('App\Models\Voto');
    }

    public function parlamentar()
    {
        return $this->belongsTo('App\Models\Parlamentar');
    }
<<<<<<< HEAD

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
=======
}
>>>>>>> c2685767d5da3a667e03f47b6f87dbc0675e27e0
