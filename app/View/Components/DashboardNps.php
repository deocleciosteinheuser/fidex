<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardNps extends Component
{
    private $aDados;
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
        return view('components.dashboard-nps', ['aDados' => $this->getDados(), 'agrupador' => ['title' => 'deo']]);
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
}
