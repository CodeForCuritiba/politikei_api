<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, JWTSubject
{
    use Authenticatable;

    protected $fillable = ['name', 'email', 'password', 'avatar_url'];
    protected $hidden = ['password', 'roles', 'confirmation', 'status', 'facebook_id'];



  	public function getJWTIdentifier() {
        return $this->id;
    }

    public function getJWTCustomClaims() {
        return [];
    }
}
