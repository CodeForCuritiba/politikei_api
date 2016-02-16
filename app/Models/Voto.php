<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class Voto extends Model 
{
    public $timestamps  = false;
    protected $fillable = ['user_id', 'proposicao_id', 'voto'];
}
