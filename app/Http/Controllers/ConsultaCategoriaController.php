<?php

namespace App\Http\Controllers;

use App\Enums\ConsultaAgrupador;
use Illuminate\Http\Request;

class ConsultaCategoriaController extends ConsultaController
{
    /**
     * {@inheritDoc}
     */
    public function getConsulta() {
        return parent::getConsulta()->setAgrupador(ConsultaAgrupador::CATEGORIA);
    }

    /**
     * {@inheritDoc}
     */
    protected function getSqlDados()
    {
        return '
            SELECT
                   categoria.nome AS agrupador,
                   nps_resposta.npsnota
              FROM unidade_sistema
              JOIN nps_pesquisa_unidade_sistema
                ON nps_pesquisa_unidade_sistema.uniid = unidade_sistema.uniid
               AND nps_pesquisa_unidade_sistema.sisid = unidade_sistema.sisid
              JOIN nps_pesquisa_usuario
                ON nps_pesquisa_usuario.npuid = nps_pesquisa_unidade_sistema.id
              JOIN nps_resposta
                ON nps_resposta.npuid = nps_pesquisa_usuario.id
              JOIN categoria
                ON categoria.id = nps_resposta.catid
              JOIN pessoa ON pessoa.id = unidade_sistema.pesid
              JOIN geo_localizacao geo ON geo.id = nps_pesquisa_unidade_sistema.geoid

            ';
    }
}
