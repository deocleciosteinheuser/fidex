<?php

namespace App\Livewire;

use App\Models\GeoLocalizacao;
use App\Models\Pessoa;
use Hamcrest\Arrays\IsArray;
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
        $aFiltro = [];
        !empty($this->filterGeo) && $aFiltro['geo.id'] = array_filter($this->filterGeo, function($val){return $val && (int) $val; });
        !empty($this->filterPessoa) && $aFiltro['pessoa.id'] = array_filter($this->filterPessoa, function($val){return $val && (int) $val; });
        !empty($this->search) && $aFiltro['agrupador'] = $this->search;
        $this->dispatch('filter-nps', $aFiltro);
        session()->flash('message', "Filtro aplicado com sucesso! " . implode(', ',
            array_map(
                function($key, $value) {
                    return $key . ': ' . (is_array($value) ? implode(',',$value) : $value);
                },
                ['search', 'geos', 'pessoas'],
                [
                    $this->search,
                    array_filter($this->geos, function($key) use($aFiltro) { return in_array($key, $this->filterGeo);}, ARRAY_FILTER_USE_KEY),
                    array_filter($this->pessoas, function($key) use($aFiltro) { return in_array($key, $this->filterPessoa);}, ARRAY_FILTER_USE_KEY),
                ]
            )) );
    }

    public function resetFilters()
    {
        session()->flash('message', 'resetFilters');
        $this->filterGeo = [];
        $this->filterPessoa = [];
        $this->search = '';
    }

}
