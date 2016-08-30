<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Config;
use DB;
use Illuminate\Http\Request;
use JWTAuth;
use Socialite;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;

class AuthController extends Controller
{

    public function verify($username, $password)
    {
        /*$user = User::where('email', $username)->first();
        if ($user && check($password, $user->password)) {
            return $user;
        }*/

        if($username == 'politikei@politikei.org' && $password = 'politikei'){
            $user = new User();
            $user->name = 'Poltikei Dev';
            $user->email = 'politikei@politikei.org';
            $user->password = app('hash')->make('politikei');;
            return $user;
        }

        return null;
    }

    public function authenticate(Request $request)
    {
        $credentials = $this->getCredentials($request);
        try 
        {
            $user = $this->verify($credentials['email'], $credentials['password']);

            if (is_null($user)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }

            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
            return response()->json(compact('token'));

        } catch (JWTException $e) 
        {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
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
        $version = 'v2.7';
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

    protected function getCredentials(Request $request)
    {
        return $request->only('email', 'password');
    }

}
