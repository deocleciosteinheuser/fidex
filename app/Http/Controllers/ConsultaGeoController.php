<?php

namespace App\Http\Controllers;

use App\Enums\ConsultaAgrupador;
use App\Models\NpsResposta;
use Illuminate\Http\Request;

class ConsultaGeoController extends ConsultaController
{
    /**
     * {@inheritDoc}
     */
    protected function getConsulta()
    {
        return parent::getConsulta()->setAgrupador(ConsultaAgrupador::GEO);
    }

    /**
     * {@inheritDoc}
     */
    protected function getSqlDados()
    {
        return '                 
            SELECT
                    geo_localizacao.nome AS agrupador,
                    nps_resposta.npsnota
            FROM nps_pesquisa_unidade_sistema
            JOIN geo_localizacao
                ON geo_localizacao.id = nps_pesquisa_unidade_sistema.geoid
            JOIN nps_pesquisa_usuario
                ON nps_pesquisa_usuario.npuid = nps_pesquisa_unidade_sistema.id
            JOIN nps_resposta
                ON nps_resposta.npuid = nps_pesquisa_usuario.id';
    }

}
