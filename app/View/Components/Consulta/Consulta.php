<?php

namespace App\View\Components\Consulta;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Consulta extends Component
{

    public array $agrupador = ['route' => 'semrota', 'title' => 'sem titulo'];

    /**
     * Create a new component instance.
     */
    public function __construct(array $agrupador)
    {
        $this->agrupador = $agrupador;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.consulta.consulta');
    }
}
