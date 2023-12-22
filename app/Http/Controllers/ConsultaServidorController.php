<?php

namespace App\Http\Controllers;

use App\Enums\ConsultaAgrupador;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class ConsultaServidorController extends ConsultaController
{
    /**
     * {@inheritDoc}
     */
    public function getConsulta() {
        return parent::getConsulta()->setAgrupador(ConsultaAgrupador::SERVIDOR);
    }

    /**
     * {@inheritDoc}
     */
    protected function getSqlDados()
    {
        return '	     
            SELECT
                   servidor.nome AS agrupador,
                   nps_resposta.npsnota
              FROM unidade_sistema
              JOIN servidor
                ON servidor.id = unidade_sistema.serid
              JOIN nps_pesquisa_unidade_sistema		 
                ON nps_pesquisa_unidade_sistema.uniid = unidade_sistema.uniid		 
               AND nps_pesquisa_unidade_sistema.sisid = unidade_sistema.sisid		 		    
              JOIN nps_pesquisa_usuario		 
                ON nps_pesquisa_usuario.npuid = nps_pesquisa_unidade_sistema.id		 		 
              JOIN nps_resposta
                ON nps_resposta.npuid = nps_pesquisa_usuario.id';
    }
}
