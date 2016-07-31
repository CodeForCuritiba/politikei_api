<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vote(Request $request)
    {
        $this->validate($request,[
            'id'=>'integer|required'
            ,'user_id'=>'integer|required'
            ,'user_vote'=>'string|size:1|required'
        ]);

        /*
        $user_id = Input::get("user_id");
        $voto_usuario = Input::get("user_vote");
        */
        $voto = Voto::where('proposicao_id', $request->input('id') )
            ->where('user_id', $request->input('user_id') )
            ->first();

        if($voto == null)
        {
            $voto = new Voto;
            $voto->user_id = $request->input('user_id');
            $voto->proposicao_id = $request->input('id');
        }

        $voto->voto = $request->input('id');
        $voto->save();

        // TODO: Create a json response with link to new recurse:
        $response = [];//['user'=>"user/{$voto->id}"];
        return response()->json($response, 201);
    }
}
