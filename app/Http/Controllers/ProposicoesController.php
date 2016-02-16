<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proposicao;
use App\Models\Voto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProposicoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $user = User::find($user_id);
        if(!$user){
            $user = new User;
            $user->id = $user_id;
            $user->roles = 0;
            $user->status = 0;
            $user->save();
        }

        $proposicoes = Proposicao::select('id', 'parlamentar_id', 'categoria_id', 'ementa', 'resumo', 'nome', 'camara_id', 'situacao', 'descricao', 'colaborador_id')->get();

        foreach ($proposicoes as $key => $value) {
            $proposicoes[$key]->votos_favor = $value->votos()->where('voto', 's')->count();
            $proposicoes[$key]->votos_contra = $value->votos()->where('voto', 'n')->count();
            $proposicoes[$key]->voto_usuario = $value->votos()->where('user_id', $user->id)->first();
        }
        
        $response = [ "user" => $user, "proposicoes" => $proposicoes];

        
        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function votar($id)
    {
        $user_id = Input::get("user_id");
        $voto_usuario = Input::get("voto_usuario");

        $voto = Voto::where('proposicao_id', $id)->where('user_id', $user_id)->first();

        if(!$voto){
            $voto = new Voto;
            $voto->user_id = $user_id;
            $voto->proposicao_id = $id;
        }

        $voto->voto = $voto_usuario;
        $voto->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
