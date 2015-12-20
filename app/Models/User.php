<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $fillable = ['name', 'email', 'password', 'avatar_id'];
    protected $hidden = ['password', 'roles', 'avatar_id', 'confirmation', 'status', 'facebook_id'];

}
