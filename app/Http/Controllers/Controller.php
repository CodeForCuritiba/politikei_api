<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Router;
use JWTAuth;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $user;

    public function __construct(Router $router)
    {
        if (!$router->is('api_auth')) {
            $this->user = JWTAuth::parseToken()->toUser();
        }
    }
}
