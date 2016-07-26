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
    public function test(Request $request)
    {

    }
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
/*
        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = $request->input("password");

        $salvedUser = $user->save();

        $response = ['user'=>$salvedUser];
*/
        //return ($salvedUser)? new Request('New user created', HTTP_CREATED)->json($response, 200, [], JSON_UNESCAPED_UNICODE) : new Request('Can\'t create new user', 500);
    }

    public function show($id)
    {
        if (empty($id)) {
            return response()
                    ->json(['id'=>["The id field is required."] ])
                    ->header('Status',422);
        }

        $find = User::find($id);

        if ($find == null) {
            header("HTTP/1.0 404 User not found");
        }
        return $find;
/*
        return ($find == null)? new Response('User not found', 204) : new Response($find, 200) ;
*/
    }

    public function edit(Request $request)
    {
        $this->validate($request,[
            'id'=>'integer|required'
            ,
        ]);
/*
        $find = $this->getUser($request->input('id') );
        return ($find == null)? new Response('User not found',204) : new Response($find, 200) ;
*/
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'id'=>'integer|required'
            ,
        ]);
/*
        $user = User::find($request->input('id') );

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        //TODO: Fazer uma response pimpa com textos legais;
        $save = $user->save();

        return ($save)? new Response('User updated',200) : new Response('Error on update user',500);
*/
    }
}
