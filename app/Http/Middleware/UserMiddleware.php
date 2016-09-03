<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->input('token');
        $user = new User();
        $result = $user->checkToken($token);
        if (!$result){
            return response()->json(['error'=>"Invalid token"],422);
        }
        $request->userdata = $result;
        return $next($request);
    }
}
