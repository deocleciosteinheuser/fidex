<?php

namespace App\Http\Controllers;

use App\View\Components\DashboardNps;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($aDados)
    {
        return (new DashboardNps())->setDados($aDados)->render();
    }

    public function usuario()
    {
        return $this->index((new \App\Http\Controllers\ConsultaUsuarioController())->json());
    }

    public function geo()
    {
        return $this->index((new \App\Http\Controllers\ConsultaGeoController())->json());
    }

    public function categoria()
    {
        return $this->index((new \App\Http\Controllers\ConsultaCategoriaController())->json());
    }


    public function periodo()
    {
        return $this->index((new \App\Http\Controllers\ConsultaPeriodoController())->json());
    }

    public function sistema()
    {
        return $this->index((new \App\Http\Controllers\ConsultaSistemaController())->json());
    }

    public function cliente()
    {
        return $this->index((new \App\Http\Controllers\ConsultaClienteController())->json());
    }

    public function unidade()
    {
        return $this->index((new \App\Http\Controllers\ConsultaUnidadeController())->json());
    }

    public function servidor()
    {
        return $this->index((new \App\Http\Controllers\ConsultaServidorController())->json());
    }

}
