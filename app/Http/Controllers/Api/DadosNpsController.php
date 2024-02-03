<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDadosNpsRequest;
use App\Http\Resources\DadosNpsResource;
use App\Models\Categoria;
use App\Models\DadosNps;
use App\Models\GeoLocalizacao;
use App\Models\Grupo;
use App\Models\ModeloAtendimento;
use App\Models\NpsFeedBack;
use App\Models\NpsPesquisa;
use App\Models\NpsPesquisaUnidadeSistema;
use App\Models\NpsPesquisaUsuario;
use App\Models\NpsResposta;
use App\Models\Pessoa;
use App\Models\Servidor;
use App\Models\Sistema;
use App\Models\Unidade;
use App\Models\UnidadeSistema;
use Database\Seeders\PessoaSeeder;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\AssignOp\Coalesce;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\DefaultValueResolver;

class DadosNpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateDadosNpsRequest $request)
    {
        //$oPessoa = Pessoa::create($request->validated());
        $aDados = (new DadosNpsResource($request))->toArray($request);
        DB::beginTransaction();
        $oPesquisa = NpsPesquisa::updateOrCreate([
            'periodo' => $aDados['pesquisa']['periodo'],
        ],[
            'datainicio' => $aDados['pesquisa']['data_inicio'],
        ]);

        foreach($aDados['pesquisa']['dados'] as $index => $oDados) {
            $oDados = (object) $oDados;

            if(!isset($oGrupo) || $oGrupo->nome != $oDados->grupo_nome) {
                $oGrupo = Grupo::updateOrCreate([
                    'nome' => $oDados->grupo_nome,
                ]);
            }
            if(!isset($oSistema) || $oSistema->nome != $oDados->sistema_nome) {
                $oSistema = Sistema::updateOrCreate([
                    'gruid' => $oGrupo->id,
                    'nome' => $oDados->sistema_nome,
                ]);
            }
            if(!isset($oGeo) || $oGeo->nome != $oDados->geo_nome) {
                $oGeo = GeoLocalizacao::updateOrCreate([
                    'nome' => $oDados->geo_nome,
                ]);
            }
            if(!isset($oModeloAtendimento) || $oModeloAtendimento->nome != $oDados->modeloatendimento_nome) {
                $oModeloAtendimento = ModeloAtendimento::updateOrCreate([
                    'nome' => $oDados->modeloatendimento_nome,
                ]);
            }
            if(!isset($oUnidade) || $oUnidade->id != $oDados->unidade_id) {
                $oUnidade = Unidade::find($oDados->unidade_id);
            }
            if(!isset($oServidor) || $oServidor->nome != $oDados->servidor_nome) {
                $oServidor = Servidor::updateOrCreate([
                    'nome' => $oDados->servidor_nome
                ]);
            }
            if(!isset($oUnidadeSistema) || !(
                    $oUnidadeSistema->uniid == $oUnidade->id &&
                    $oUnidadeSistema->sisid == $oSistema->id &&
                    $oUnidadeSistema->serid == $oServidor->id
                )
            ) {
                $oUnidadeSistema = UnidadeSistema::updateOrCreate([
                    'uniid' => $oUnidade->id,
                    'sisid' => $oSistema->id,
                    'serid'  => $oServidor->id,
                ]);
            }
            if(!isset($oCategoria) || $oCategoria->nome != $oDados->categoria_nome) {
                $oCategoria = Categoria::updateOrCreate([
                    'nome' => $oDados->categoria_nome? : 'Outros',
                ]);
            }
            $oPesquisaUnidadeSistema = NpsPesquisaUnidadeSistema::updateOrCreate([
                'nppid' => $oPesquisa->id,
                'sisid' => $oSistema->id,
                'uniid' => $oUnidade->id,
                'serid' => $oServidor->id,
                'geoid' => $oGeo->id,
                'matid' => $oModeloAtendimento->id,
            ],
            [
                'mrr' => $oUnidadeSistema->mrr,
            ]
            );

            $oPesquisaUsuario = NpsPesquisaUsuario::create([
                'npuid' => $oPesquisaUnidadeSistema->id,
            ]);
            $oResp = NpsResposta::create([
                'npuid'     => $oPesquisaUsuario->id,
                'data'      => DateTime::createFromFormat('d/m/y H:i', $oDados->resposta_data)->format('Y-m-d H:i'),
                'npsnota'   => $oDados->resposta_nota,
                'descricao' => $oDados->resposta_descricao,
                'catid'     => $oCategoria->id,
            ]);

            NpsFeedback::create([
                'npuid' => $oPesquisaUsuario->id,
                'descricao' => isset($oDados->descricao) ? $oDados->descricao : '',
                'visto' => Str::lower($oDados->feedback_visto) == 'sim',
                'util'  => Str::lower($oDados->feedback_util) == 'sim',
                'pesid' => $oUnidadeSistema->pesid,
            ]);
        }
        DB::commit();
        return response()->json(['message' => 'Incluido com sucesso'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(DadosNps $dadosNps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DadosNps $dadosNps)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DadosNps $dadosNps)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DadosNps $dadosNps)
    {
        //
    }
}
