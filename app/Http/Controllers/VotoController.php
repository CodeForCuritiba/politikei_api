<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VotosUsers;
use App\VotosParlamentares;

class VotoController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function votoUser(Request $request)
    {

        // Get user from middleware
        $user = $request->userdata;

        $this->validate($request,[
            'proposicao_id'=>'integer|required',
            'voto'=>'string|size:1|required'
        ]);

        $voto = VotosUsers::where('proposicao_id', $request->input('proposicao_id') )->where('user_id', $user->id)->first();

        if($voto == null)
        {
            $voto = new VotosUsers;
            $voto->user_id = $user->id;
            $voto->proposicao_id = $request->input('proposicao_id');
        }

        $voto->voto = $request->input('voto');
        $voto->save();

        $response = ['status'=>'Registrado'];
        return response()->json($response, 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function votoParlamentar(Request $request)
    {
        $this->validate($request,[
            'parlamentar_id'=>'integer|required',
            'proposicao_id'=>'integer|required',
            'voto'=>'string|size:1|required'
        ]);

        $voto = VotoParlamentar::where('proposicao_id', $request->input('proposicao_id') )->where('parlamentar_id', $request->input('parlamentar_id') )->first();

        if($voto == null)
        {
            $voto = new VotoParlamentar();
            $voto->parlamentar_id = $request->input('parlamentar_id');
            $voto->proposicao_id = $request->input('proposicao_id');
        }

        $voto->voto = $request->input('voto');
        $voto->save();

        $response = ['status'=>'Registrado'];
        return response()->json($response, 201);
    }
}
