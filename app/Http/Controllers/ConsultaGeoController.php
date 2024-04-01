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

            ';
    }

}
