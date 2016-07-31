<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VotoUser extends Model
{
    public $timestamps  = false;
    protected $fillable = ['user_id', 'proposicao_id', 'voto'];
}
