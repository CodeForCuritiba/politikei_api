<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Log;
use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;

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

    public function checkToken($token){

        $client = new Client();

        try {

            $graphUrl = 'https://graph.facebook.com';
            $version = 'v2.7';

            $response = $client->get($graphUrl.'/me?fields=name,picture,email&access_token=' . $token, ['verify' => false]);

            $content = $response->getBody();

            $providerUser = json_decode($content);

            return $providerUser;

        } catch (ClientException $e){

            return false;

        }


    }

}
