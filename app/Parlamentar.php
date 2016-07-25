<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class Parlamentar extends Model 
{
	protected $table = 'parlamentares';
    public $timestamps  = false;
    protected $fillable = ['nome', 'estado', 'partido_sigla', 'avatar_url'];
}
