<?php
namespace App\Http\Controllers;

use App\Proposicao;
use App\Voto;
use Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProposicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$user = Auth::user();
        $user = (object)['id'=>1];

        //$proposicoes = Proposicao::select('id', 'tipo', 'nome', 'parlamentar_id', 'categoria_id', 'ementa', 'resumo', 'nome', 'camara_id', 'situacao', 'descricao', 'colaborador_id')->whereNotNull('parlamentar_id')->get();
        //$proposicoes = Proposicao::select('id', 'nome', 'descricao', 'resumo', 'ementa', 'categoria', 'camara', 'situacao', 'autor', 'parlamentar', 'parlamentar_partido', 'data_apresentacao', 'data_conclusao', 'regime_tramitacao', 'apreciacao', 'explicacao_ementa','link','numero','ano' )->get();

        $proposicoes = Proposicao::all();

        foreach ($proposicoes as $key => $value) {
            $proposicoes[$key]->votos_favor = $value->votosUser()->where('voto', 's')->count();
            $proposicoes[$key]->votos_contra = $value->votosUser()->where('voto', 'n')->count();
        }

        if($user != null){
            foreach ($proposicoes as $key => $value) {
                $proposicoes[$key]->voto_usuario = $value->votosUser()->where('user_id', $user->id)->first();
                $proposicoes[$key]->parlamentar = $value->parlamentar()->first();
            }
        }

        $response = ["proposicoes" => $proposicoes];
        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
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
            'nome'=>'required|string',
            'descricao'=>'required|string',
            'resumo'=>'required|string',
            'ementa'=>'required|string',
            'categoria'=>'required|string',
            'camara'=>'required|string',
            'situacao'=>'required|string',
            'autor'=>'required|string',
            'parlamentar'=>'required|string',
            'parlamentar_partido'=>'required|string',
            'data_apresentacao'=>'required|date_format:Y-m-d|before:now',
            'data_conclusao'=>'required|date_format:Y-m-d|after:data_apresentacao|before:now',
            'regime_tramitacao'=>'required|string',
            'apreciacao'=>'required|string',
            'explicacao_ementa'=>'required|string',
            'link'=>'required|url',
            'numero'=>'required|integer',
            'ano'=>'required|date_format:Y'
        ]);

        $proposicao = new Proposicao();
        $proposicao->nome                 = $request->input("nome");
        $proposicao->descricao            = $request->input("descricao");
        $proposicao->resumo               = $request->input("resumo");
        $proposicao->ementa               = $request->input("ementa");
        $proposicao->categoria            = $request->input("categoria");
        $proposicao->camara               = $request->input("camara");
        $proposicao->situacao             = $request->input("situacao");
        $proposicao->autor                = $request->input("autor");
        $proposicao->parlamentar          = $request->input("parlamentar");
        $proposicao->parlamentar_partido  = $request->input("parlamentar_partido");
        $proposicao->data_apresentacao    = $request->input("data_apresentacao");
        $proposicao->data_conclusao       = $request->input("data_conclusao");
        $proposicao->regime_tramitacao    = $request->input("regime_tramitacao");
        $proposicao->apreciacao           = $request->input("apreciacao");
        $proposicao->explicacao_ementa    = $request->input("explicacao_ementa");
        $proposicao->link                 = $request->input("link");
        $proposicao->numero               = $request->input("numero");
        $proposicao->ano                  = $request->input("ano");
        $proposicao->save();

        $response = ['proposicao'=>"proposicao/{$proposicao->id}"];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (empty($id) ) {
            return response()->json(['id'=>["The id field is required or invalid id"] ],422);
        }

        $find = Proposicao::find($id);
        if ($find == null) {
            return response()->json(['id'=>["Project not found"] ],404);
        }
        return $find;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|integer|exists:proposicoes,id',
            'nome'=>'required|string',
            'descricao'=>'required|string',
            'resumo'=>'required|string',
            'ementa'=>'required|string',
            'categoria'=>'required|string',
            'camara'=>'required|string',
            'situacao'=>'required|string',
            'autor'=>'required|string',
            'parlamentar'=>'required|string',
            'parlamentar_partido'=>'required|string',
            'data_apresentacao'=>'required|date_format:Y-m-d|before:now',
            'data_conclusao'=>'required|date_format:Y-m-d|after:data_apresentacao|before:now',
            'regime_tramitacao'=>'required|string',
            'apreciacao'=>'required|string',
            'explicacao_ementa'=>'required|string',
            'link'=>'required|url',
            'numero'=>'required|integer',
            'ano'=>'required|date_format:Y'
        ]);

        $proposicao = Proposicao::find($request->input('id') );

        if ($proposicao == null) {
            return response()->json(['id'=>["User not found"] ],404);
        }

        $proposicao->nome                 = $request->input("nome");
        $proposicao->descricao            = $request->input("descricao");
        $proposicao->resumo               = $request->input("resumo");
        $proposicao->ementa               = $request->input("ementa");
        $proposicao->categoria            = $request->input("categoria");
        $proposicao->camara               = $request->input("camara");
        $proposicao->situacao             = $request->input("situacao");
        $proposicao->autor                = $request->input("autor");
        $proposicao->parlamentar          = $request->input("parlamentar");
        $proposicao->parlamentar_partido  = $request->input("parlamentar_partido");
        $proposicao->data_apresentacao    = $request->input("data_apresentacao");
        $proposicao->data_conclusao       = $request->input("data_conclusao");
        $proposicao->regime_tramitacao    = $request->input("regime_tramitacao");
        $proposicao->apreciacao           = $request->input("apreciacao");
        $proposicao->explicacao_ementa    = $request->input("explicacao_ementa");
        $proposicao->link                 = $request->input("link");
        $proposicao->numero               = $request->input("numero");
        $proposicao->ano                  = $request->input("ano");

        $proposicao->save();
        $response = ['proposicao'=>"proposicao/{$proposicao->id}"];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|integer|exists:proposicoes,id'
        ]);

        Proposicao::destroy($request->input('id') );
    }
}
