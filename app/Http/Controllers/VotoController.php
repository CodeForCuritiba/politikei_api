<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\VotosUsers;
use App\VotosParlamentares;
use App\Ranking;

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

        $voto = VotoParlamentares::where('proposicao_id', $request->input('proposicao_id') )->where('parlamentar_id', $request->input('parlamentar_id') )->first();

        if($voto == null)
        {
            $voto = new VotoParlamentares();
            $voto->parlamentar_id = $request->input('parlamentar_id');
            $voto->proposicao_id = $request->input('proposicao_id');
        }

        $voto->voto = $request->input('voto');
        $voto->save();

        $response = ['status'=>'Registrado'];
        return response()->json($response, 201);
    }

    public function ranking(Request $request)
    {
       // Get user from middleware
       $user = $request->userdata;

       //$ranking = Ranking::where('user_id', $user->id);
       $ranking = DB::select('Select parlamentar_id, parlamentar_nome, partido_sigla, QtdeProposicoes, Sim, Nao, NaoSei
                                      from Ranking WHERE User_id=:id order by Sim', ['id' => $user->id]);
       /*
       $ranking = DB::select('Select
                                  p.id as parlamentar_id,
                                  p.nome as parlamentar_nome,
                                  p.partido_sigla,
                                  Sum(v.UserMatch) as QtdeProposicoes,
                                  ROUND((Sum(v.Sim)/Count(Distinct v.proposicao_id))*100,2) as Sim,
                                  ROUND((Sum(v.Nao)/Count(Distinct v.proposicao_id))*100,2) as Nao,
                                  ROUND((Sum(v.NaoSei)/Count(Distinct v.proposicao_id))*100,2) as NaoSei
                              From
                                  Parlamentares p
                                      Inner Join
                                          (SELECT
                                              vu.User_id,
                                              vp.proposicao_id,
                                              vp.parlamentar_id,
                                              if(vp.voto = 0, 1, 0) AS Nao,
                                              if(vp.voto = 1, 1, 0) AS Sim,
                                              if(vp.voto = 2, 1, 0) AS NaoSei,
                                              if(vp.voto = vu.voto, 1, 0) as UserMatch
                                          FROM
                                              Votos_Parlamentares vp
                                                  INNER JOIN votos_users vu ON vp.proposicao_id = vu.proposicao_id) v
                                      on p.id = v.parlamentar_id
                              WHERE v.User_Id = :id
                              Group by
                                  v.User_id,
                                  p.nome,
                                  p.partido_sigla
                              Order by
                                  Sum(v.UserMatch) desc, p.nome asc
                              Limit 20', ['id' => $user->id]);
       */

       return response()->json(['ranking'=> $ranking]);

    }
}
