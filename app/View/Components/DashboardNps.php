<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardNps extends Component
{
    private $aDados;
    private $oAgrupador;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-nps', [
            'aDados' => $this->getDados(),
            'agrupador' => $this->getAgrupador()
        ]);
    }



    /**
     * Get the value of aDados
     */
    public function getDados()
    {
        return $this->aDados;
    }

    /**
     * Set the value of aDados
     *
     * @return  self
     */
    public function setDados($aDados)
    {
        $this->aDados = $aDados;
        return $this;
    }


    /**
     * Get the value of oAgrupador
     */
    public function getAgrupador()
    {
        return $this->oAgrupador;
    }

    /**
     * Set the value of oAgrupador
     *
     * @return  self
     */
    public function setAgrupador($oAgrupador)
    {
        $this->oAgrupador = $oAgrupador;
        return $this;
    }
}
