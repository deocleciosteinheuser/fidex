<?php

namespace App\Http\Controllers;

use App\Enums\ConsultaAgrupador;
use App\View\Components\DashboardNps;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($aDados, $agrupador)
    {
        return (new DashboardNps())->setDados($aDados)->setAgrupador($agrupador)->render();
    }

    public function usuario()
    {
        return $this->index((new \App\Http\Controllers\ConsultaUsuarioController())->json(), ConsultaAgrupador::dados(ConsultaAgrupador::USUARIO));
    }

    public function geo()
    {
        return $this->index((new \App\Http\Controllers\ConsultaGeoController())->json(), ConsultaAgrupador::dados(ConsultaAgrupador::GEO));
    }

    public function categoria()
    {
        return $this->index((new \App\Http\Controllers\ConsultaCategoriaController())->json(), ConsultaAgrupador::dados(ConsultaAgrupador::CATEGORIA));
    }


    public function periodo()
    {
        return $this->index((new \App\Http\Controllers\ConsultaPeriodoController())->json(), ConsultaAgrupador::dados(ConsultaAgrupador::PERIODO));
    }

    public function sistema()
    {
        return $this->index((new \App\Http\Controllers\ConsultaSistemaController())->json(), ConsultaAgrupador::dados(ConsultaAgrupador::SISTEMA));
    }

    public function cliente()
    {
        return $this->index((new \App\Http\Controllers\ConsultaClienteController())->json(), ConsultaAgrupador::dados(ConsultaAgrupador::CLIENTE));
    }

    public function unidade()
    {
        return $this->index((new \App\Http\Controllers\ConsultaUnidadeController())->json(), ConsultaAgrupador::dados(ConsultaAgrupador::UNIDADE));
    }

    public function servidor()
    {
        return $this->index((new \App\Http\Controllers\ConsultaServidorController())->json(), ConsultaAgrupador::dados(ConsultaAgrupador::SERVIDOR));
    }

}
