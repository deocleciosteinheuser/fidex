<?php

namespace App\Http\Controllers;

use App\Enums\ConsultaAgrupador;
use Illuminate\Http\Request;

class ConsultaUsuarioController extends ConsultaController
{
    /**
     * {@inheritDoc}
     */
    protected function getConsulta()
    {
        return parent::getConsulta()->setAgrupador(ConsultaAgrupador::USUARIO);
    }

    /**
     * {@inheritDoc}
     */
    protected function getSqlDados()
    {
        return '                 
            SELECT
                   pessoa.nome AS agrupador,
                   nps_resposta.npsnota
              FROM unidade_sistema
              JOIN usuario
                ON usuario.id = unidade_sistema.usuid
              JOIN pessoa
                ON pessoa.id = usuario.pesid
              JOIN nps_pesquisa_unidade_sistema		 
                ON nps_pesquisa_unidade_sistema.uniid = unidade_sistema.uniid		 
               AND nps_pesquisa_unidade_sistema.sisid = unidade_sistema.sisid		 		    
              JOIN nps_pesquisa_usuario		 
                ON nps_pesquisa_usuario.npuid = nps_pesquisa_unidade_sistema.id		 		 
              JOIN nps_resposta
                ON nps_resposta.npuid = nps_pesquisa_usuario.id';
    }

}
