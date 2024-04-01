<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardNps extends Component
{
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
            'agrupador' => $this->getAgrupador()
        ]);
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
