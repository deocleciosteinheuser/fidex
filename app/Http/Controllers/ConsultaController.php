<?php

namespace App\Http\Controllers;

use App\Enums\ConsultaAgrupador;
use App\View\Components\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{
    private $order = [];
    private $limit = 0;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->getConsulta()->render();
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

    public function dados($tipo) {
        switch($tipo) {
            case 'json' :
                return $this->json();
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
                   nps_resposta.npsnota
              FROM nps_resposta
            ";
    }

    public function json() {
        return DB::select('
        WITH parametros AS (
             SELECT ARRAY[9,10] AS nota_promotor,
                    ARRAY[7,8] AS nota_neutro,
                    ARRAY[6,5,4,3,2,1,0] AS nota_detrator
             ),
             dados AS (
                ' . $this->getSqlDados() . '
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
               GROUP BY dados.agrupador
             ),
             calculo as (
                 SELECT
                        dados_agrupados.agrupador,
                        respostas_promotor,
                        respostas_neutro,
                        respostas_detrator,
                        respostas,
                        ROUND(respostas_promotor / respostas * 100, 0) percentual_promotor,
                        ROUND(respostas_neutro / respostas * 100)::numeric(10,0) percentual_neutro,
                        ROUND(respostas_detrator / respostas * 100)::numeric(10,0) percentual_detrator,
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
         ' . $this->getOrder() . '
         ' . $this->getLimit() . '

        ');
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
