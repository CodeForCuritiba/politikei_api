<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VotosUsers extends Model
{
    public $timestamps  = false;
    protected $fillable = ['user_id', 'proposicao_id', 'voto'];
}
