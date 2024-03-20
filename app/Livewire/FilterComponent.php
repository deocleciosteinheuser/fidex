<?php

namespace App\Livewire;

use App\Models\GeoLocalizacao;
use App\Models\Pessoa;
use Livewire\Component;

class FilterComponent extends Component
{
    public $geos;
    public array $filterGeo;
    public $pessoas;
    public array $filterPessoa;

    public $search = '';

    public function render()
    {
        $this->carregaDados();
        return view('livewire.filter-component');
    }

    private function carregaDados() {
        $this->pessoas = Pessoa::getSelectOptions();
        $this->geos = GeoLocalizacao::getSelectOptions();
    }

    public function submitFilters()
    {
        session()->flash('message', "Filtro aplicado com sucesso! geo: " . implode($this->filterGeo) . ", pessoa: " . implode($this->filterPessoa));
        $aFiltro = [];
        !empty($this->filterGeo) && $aFiltro['geo.id'] = array_filter($this->filterGeo, function($val){return $val && (int) $val; });
        !empty($this->filterPessoa) && $aFiltro['pessoa.id'] = array_filter($this->filterPessoa, function($val){return $val && (int) $val; });
        $this->dispatch('filter-nps', $aFiltro);
    }

    public function resetFilters()
    {
        session()->flash('message', 'resetFilters');
        $this->filterGeo = [];
        $this->filterPessoa = [];
        $this->search = '';
    }

}
