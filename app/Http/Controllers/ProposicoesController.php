<?php
namespace App\Http\Controllers;

use App\Proposicao;
use App\Voto;
use Auth;
use App\Http\Controllers\Controller;
/*
use App\Models\Proposicao;
use App\Models\Voto;
use App\Models\User;
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProposicoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: Alterar para pegar pelo usuario autenticado
//        $user = Auth::user();
        $user = (object)['id'=>4];

        //$proposicoes = Proposicao::select('id', 'tipo', 'nome', 'parlamentar_id', 'categoria_id', 'ementa', 'resumo', 'nome', 'camara_id', 'situacao', 'descricao', 'colaborador_id')->whereNotNull('parlamentar_id')->get();

        $proposicoes = Proposicao::select('id', 'nome', 'descricao', 'resumo', 'ementa', 'categoria',
           'camara', 'situacao', 'autor', 'parlamentar', 'parlamentar_partido', 'data_apresentacao',
           'data_conclusao', 'regime_tramitacao', 'apreciacao', 'explicacao_ementa','link','numero','ano')->get();

        foreach ($proposicoes as $key => $value) {
            $proposicoes[$key]->votos_favor = $value->votos()->where('voto', 's')->count();
            $proposicoes[$key]->votos_contra = $value->votos()->where('voto', 'n')->count();
            $proposicoes[$key]->voto_usuario = $value->votos()->where('user_id', $user->id)->first();
            $proposicoes[$key]->parlamentar = $value->parlamentar()->first();
        }

        $response = ["proposicoes" => $proposicoes];
        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
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

        /*$user_id = Input::get("user_id");
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id'=>'integer|required'
            ,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->validate($request,[
            'id'=>'integer|required'
            ,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->validate($request,[
            'id'=>'integer|required'
            ,
        ]);
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
        $this->validate($request,[
            'id'=>'integer|required'
            ,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->validate($request,[
            'id'=>'integer|required'
            ,
        ]);
    }
}
