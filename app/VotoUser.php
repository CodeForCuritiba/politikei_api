<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD:app/Voto.php
class Voto extends Model
=======
class VotoUser extends Model
>>>>>>> ddd55eabab386baaf651e39a5ef9af2d2f066740:app/VotoUser.php
{
    public $timestamps  = false;
    protected $fillable = ['user_id', 'proposicao_id', 'voto'];
}
