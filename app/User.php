<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Log;

class User extends Model implements AuthenticatableContract, JWTSubject
{
    use Authenticatable;

    protected $fillable = ['name', 'email', 'avatar_url', 'id'];
    protected $hidden = ['password', 'roles', 'confirmation', 'status', 'facebook_id'];

  	public function getJWTIdentifier() {
  		Log::debug($this->id);
        return $this->id;
    }

    public function getJWTCustomClaims() {
        return ['uid' => $this->id];
    }
}
