<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function getIndex()
    {
        $users = User::all();
        return response()->json($users);
    }
}
