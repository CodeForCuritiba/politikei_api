<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;

/*
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Validation\Validator;
*/
class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function create()
    {
        //return view("user.create");
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
            ,'email'=>'email|required'
            ,'password'=>'min:6|required'
            ,
        ]);

        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = $request->input("password");

        $salvedUser = $user->save();

        $response = ['user'=>"user/{$user->id}"];

        return response()->json($response, 201);
    }

    public function show($id)
    {
        if (empty($id) ) {
            return response()
            ->json(['id'=>["The id field is required or invalid id"] ],422);
        }

        $find = User::find($id);
        if ($find == null) {
            return response()
            ->json(['id'=>["User not found"] ],404);
        }
        return $find;
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'id'=>'integer|required'
            ,'name'=>'required'
            ,'email'=>'email|required'
            ,'password'=>'min:6|required'
            ,
        ]);

        $user = User::find($request->input('id') );


        if ($user == null) {
            return response()
            ->json(['id'=>["User not found"] ],404);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        $user->save();
        $response = ['user'=>"user/{$user->id}"];

        return response()->json($response, 200);
    }
}
