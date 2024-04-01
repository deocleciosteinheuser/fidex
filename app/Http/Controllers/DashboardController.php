<?php

namespace App\Http\Controllers;

use App\Enums\ConsultaAgrupador;
use App\View\Components\DashboardNps;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($agrupador)
    {
        $constante = "App\Enums\ConsultaAgrupador::" . Str::upper($agrupador);
        //dd($constante);
        return (new DashboardNps())->setAgrupador(ConsultaAgrupador::dados(constant($constante)))->render();
    }

}
