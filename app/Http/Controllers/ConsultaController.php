<?php

namespace App\Http\Controllers;

use App\Enums\ConsultaAgrupador;
use App\View\Components\Consulta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConsultaController extends Controller
{
    private $order = [];
    private $limit = 0;

    /**
     * Display a listing of the resource.
     */
    public function index($agrupador)
    {
        $constante = "App\Enums\ConsultaAgrupador::" . Str::upper($agrupador);
        return $this->getConsulta()->setAgrupador(constant($constante))->render();
    }

    protected function getConsulta() {
        return new Consulta();
    }

    /**
     * Lista de agrupadores de consulta
     */
    public static function agrupadores()
    {
        $aReturn = [];
        foreach(ConsultaAgrupador::all() as $Const) {
            $aReturn[] = ConsultaAgrupador::dados($Const);
        }
        return $aReturn;
    }

    public function dados($agrupador, $tipo) {
        $constante = "App\Enums\ConsultaAgrupador::" . Str::upper($agrupador);
        switch($tipo) {
            case 'json' :
                return (new ("App\\Http\\Controllers\\Consulta" . ucwords($agrupador) . "Controller")())->json();
            default:
                return '';
        }
    }

    /**
     * Retorna sql com os dados da consulta
     * @return string
     */
    protected function getSqlDados() {
        return "
            SELECT
                   'score' AS agrupador,
                   pessoa.id AS id,
                   nps_resposta.npsnota
              FROM unidade_sistema
              JOIN nps_pesquisa_unidade_sistema
                ON nps_pesquisa_unidade_sistema.uniid = unidade_sistema.uniid
               AND nps_pesquisa_unidade_sistema.sisid = unidade_sistema.sisid
              JOIN nps_pesquisa_usuario
                ON nps_pesquisa_usuario.npuid = nps_pesquisa_unidade_sistema.id
              JOIN nps_resposta
                ON nps_resposta.npuid = nps_pesquisa_usuario.id
              JOIN pessoa ON pessoa.id = unidade_sistema.pesid
              JOIN geo_localizacao geo ON geo.id = nps_pesquisa_unidade_sistema.geoid
             WHERE TRUE
        ";

    }

    public function json($filter = []) {
        $sFiltro = '';
        $sFiltroAgrupador = '';
        $aValoresFiltro = [];
        foreach($filter  as $key => $value) {
            if($key == 'agrupador') {
               $sFiltroAgrupador = " AND agrupador ILIKE :{$key}";
               $aValoresFiltro[$key] = "%$value%";
            } else {
               $sFiltro .= " AND $key in(" . implode(',' ,$value) . ") \n";
            }
        }
        return DB::select("
        WITH parametros AS (
             SELECT ARRAY[9,10] AS nota_promotor,
                    ARRAY[7,8] AS nota_neutro,
                    ARRAY[6,5,4,3,2,1,0] AS nota_detrator
             ),
             dados AS (
                {$this->getSqlDados()}
                {$sFiltro}
              ),
             dados_agrupados AS (
                 SELECT
                        dados.agrupador,
                        COUNT(*) FILTER(WHERE dados.npsnota = any(parametros.nota_promotor))::numeric AS respostas_promotor,
                        COUNT(*) FILTER(WHERE dados.npsnota = any(parametros.nota_neutro))::numeric AS respostas_neutro,
                        COUNT(*) FILTER(WHERE dados.npsnota = any(parametros.nota_detrator))::numeric AS respostas_detrator,
                        COUNT(*)::numeric AS respostas
                   FROM dados
             CROSS JOIN parametros
                  WHERE TRUE
                  {$sFiltroAgrupador}
               GROUP BY dados.agrupador
             ),
             calculo AS (
                 SELECT
                        dados_agrupados.agrupador,
                        respostas_promotor,
                        respostas_neutro,
                        respostas_detrator,
                        respostas,
                        ROUND(respostas_promotor / respostas * 100, 0) AS percentual_promotor,
                        ROUND(respostas_neutro / respostas * 100)::numeric(10,0) AS percentual_neutro,
                        ROUND(respostas_detrator / respostas * 100)::numeric(10,0) AS percentual_detrator,
                        ROUND(ROUND(respostas_promotor / respostas * 100, 0) - ROUND(respostas_detrator / respostas * 100, 0), 0) AS nota_nps,
                        ROUND((respostas / SUM(respostas) OVER()) * 100, 0) AS percentual_nps
                   FROM dados_agrupados
             )

        SELECT
               agrupador,
               percentual_promotor AS promotor,
               percentual_neutro AS neutro,
               percentual_detrator AS detrator,
               nota_nps,
               percentual_nps,
               respostas_promotor,
               respostas_neutro,
               respostas_detrator,
               respostas AS total_resposta
          FROM calculo
          {$this->getOrder()}
          {$this->getLimit()}
        ", $aValoresFiltro);
    }

    public function order(...$sOrder) {
        $this->order = $sOrder;
        return $this;
    }

    public function limit($iLimit = 0) {
        $this->limit = $iLimit;
        return $this;
    }

    protected function getOrder() {
        return count($this->order) ? 'ORDER BY ' . implode($this->order) : '';
    }

    protected function getLimit() {
        return $this->limit ? 'limit ' . $this->limit : '';
    }
}
