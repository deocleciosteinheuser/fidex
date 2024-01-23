<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUnidadeSistemaRequest;
use App\Http\Resources\UnidadeSistemaResource;
use App\Models\Cliente;
use App\Models\GeoLocalizacao;
use App\Models\ModeloAtendimento;
use App\Models\Pessoa;
use App\Models\Servidor;
use App\Models\Sistema;
use App\Models\Unidade;
use App\Models\UnidadeSistema;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UnidadeSistemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateUnidadeSistemaRequest $request)
    {
        $request->validated();
        //$oPessoa = Pessoa::create($request->validated());

        $oUnidadeSistema = $request->validated();
        $oSistema = Sistema::updateOrCreate(array_filter([
            'id' => isset($oUnidadeSistema['sistema']['id'])? $oUnidadeSistema['sistema']['id']: null,
            'nome' => isset($oUnidadeSistema['sistema']['id']) ? null : $oUnidadeSistema['sistema']['nome'],
        ]),[
            'nome' => $oUnidadeSistema['sistema']['nome'],
        ]);
        $aUnidade = [];
        foreach($oUnidadeSistema['unidades'] as $oDados) {
            $oDados = (object) $oDados;
            $oGeo = GeoLocalizacao::updateOrCreate(array_filter([
                'id' => isset($oDados->geo_id)? $oDados->geo_id: null,
                'nome' => isset($oDados->geo_id) ? null : $oDados->geo_nome,
            ]),[
                'nome' => $oDados->geo_nome,
            ]);
            if(isset($oDados->cliente_id) || isset($oDados->cliente_nome)) {
                $oCliente = Cliente::updateOrCreate(array_filter([
                    'id' => isset($oDados->cliente_id)? $oDados->cliente_id: null,
                    'nome' => isset($oDados->cliente_id) ? null : $oDados->cliente_nome,
                ]),[
                    'nome' => $oDados->cliente_nome,
                ]);
    
            } else {
                //se não tiver cliente replica a unidade
                $oCliente = Cliente::updateOrCreate(array_filter([
                    'id' => isset($oDados->unidade_id)? $oDados->unidade_id: null,
                    'nome' => isset($oDados->unidade_id) ? null : $oDados->unidade_nome,
                ]),[
                    'nome' => $oDados->unidade_nome,
                ]);
    
            }
            $oModeloAtendimento = ModeloAtendimento::updateOrCreate([
                'nome' => $oDados->modelo_atendimento_nome,
            ]);            
            $oUnidade = Unidade::updateOrCreate(array_filter([
                'id' => isset($oDados->unidade_id)? $oDados->unidade_id: null,
                'nome' => isset($oDados->unidade_id) ? null : $oDados->unidade_nome,
            ]),[
                'cliid' => $oCliente->id,
                'nome'  => $oDados->unidade_nome,
                'geoid' => $oGeo->id,
                'matid' => $oModeloAtendimento->id,
            ]);
            $oServidor = Servidor::updateOrCreate(array_filter([
                'id' => isset($oDados->servidor_id)? $oDados->servidor_id: null,
                'nome' => isset($oDados->servidor_id) ? null : $oDados->servidor_nome,
            ]),[
                'nome' => $oDados->servidor_nome,
            ]);
            $oPessoa = Pessoa::updateOrCreate(array_filter([
                'id' => isset($oDados->pessoa_id)? $oDados->pessoa_id: null,
                'nome' => isset($oDados->pessoa_id) ? null : (isset($oDados->pessoa_nome) ? $oDados->pessoa_nome : $oDados->cs),
            ]),[
                'nome' => isset($oDados->pessoa_id) ? null : (isset($oDados->pessoa_nome) ? $oDados->pessoa_nome : $oDados->cs),
            ]);

            $oUsuario = User::updateOrCreate(array_filter([
                'pesid' => $oPessoa->id,
            ]),[
            ]);


            $aUnidade[] = new UnidadeSistemaResource(
                UnidadeSistema::updateOrCreate([
                    'uniid' => $oUnidade->id,
                    'sisid' => $oSistema->id,
                ],[
                    'mrr' => $oDados->mrr,
                    'serid' => $oServidor->id,
                    'usuid' => $oUsuario->id,
                ])
            );
            
        }    
        return response()->json($aUnidade, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
