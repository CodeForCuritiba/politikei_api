<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Config;
use DB;
use Illuminate\Http\Request;
use JWTAuth;
use Socialite;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    public function authenticate(Request $request)
    {
        $credentials = [
            'email' => $request->input('email'),
        ];

        // Generate encrypted password
        $query = DB::select("SELECT ENCODE(?, ?) AS password", [$request->input('password'), Config::get('api.encode_code_word')]);
        $credentials['password'] = $query[0]->password;

        // Tenta autenticar
        try {
            // Busca Usuario
            $user = User::where($credentials)->first();

            // Se não encontrou
            if (is_null($user)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }

            // Tenta criar token para o usuário
            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }

        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    public function oAuth(Request $request, $provider)
    {
        $accessToken = $request->input('accessToken');
        $uuid = $request->input('uuid');

        try {
            //authenticate in provider
            $providerUser = $this->getProviderUser($provider, $accessToken);
     
            if($providerUser[$provider.'_id'] != $uuid) {
                return response()->json(['error' => 'invalid_credentials'], 401);    
            }

            //find or save the in our database
            $user = $this->createOrUpdateUser($providerUser, $provider);

            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
         
            return response()->json(compact('token'));

        } catch (Exception $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
    }

    //TODO: add ohter provioders
    private function getProviderUser($provider, $accessToken)
    {
        $client = new \GuzzleHttp\Client();

        //facebook stauff
        $graphUrl = 'https://graph.facebook.com';
        $version = 'v2.5';
        $response = $client->get($graphUrl.'/me?fields=name,picture,email&access_token=' . $accessToken, ['verify' => false]);
        $providerUser = json_decode($response->getBody());
        $avatarUrl = $graphUrl.'/'.$version.'/'.$providerUser->id.'/picture';


        $user = new User();
        $user[$provider.'_id'] = $providerUser->id;
        $user->name = isset($providerUser->name) ? $providerUser->name : null;
        $user->email = isset($providerUser->email) ? $providerUser->email : null;
        //$user->avatar = $avatarUrl.'?type=normal';

        return $user;
    }

    private function createOrUpdateUser($user, $provider)
    {
        $authUser = User::where($provider.'_id', $user[$provider.'_id'])->first();

        if ($authUser != null) {
            return $authUser;
        }

        $user->save();
        return $user;
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

}
