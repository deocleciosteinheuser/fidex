<?php

namespace App\View\Components;

use App\Enums\ConsultaAgrupador;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Consulta extends Component
{
    private array $agrupador = ['route' => 'semrota', 'title' => 'sem titulo'];

    public function setAgrupador($aAgrupador) {
        $this->agrupador = ConsultaAgrupador::dados($aAgrupador);
        return $this;
    }

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
        return view('components.consulta', ['agrupador' => $this->agrupador]);
    }
}
