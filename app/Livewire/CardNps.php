<?php

namespace App\Livewire;

use App\Http\Controllers\ConsultaUsuarioController;
use App\Models\Pessoa;
use Livewire\Component;

class CardNps extends Component
{
    public $agrupador;
    public $dados;
    public $filtro;
    public $listeners = [
        'filter-nps' => 'filterNps'
    ];

    public function mount()
    {
        //dd($this->agrupador);
        $this->dados = (new ("App\\Http\\Controllers\\Consulta" . ucwords($this->agrupador) . "Controller")())->json();
    }

    public function render()
    {
        $this->dispatch('requisicaoConcluida');
        return view('livewire.card-nps', ['dados' => $this->dados]);
    }

    public function filterNps($aFiltro)
    {
        $this->dados = (new ("App\\Http\\Controllers\\Consulta" . ucwords($this->agrupador) . "Controller")())->json(array_filter($aFiltro));
    }
}
