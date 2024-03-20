<?php

namespace App\Livewire;

use App\Models\GeoLocalizacao;
use Livewire\Component;

class FilterGeo extends Component
{
    public $geo;

    public function render()
    {
        $geos = GeoLocalizacao::all();
        return view('livewire.filter-geo', ['geos' => $geos]);
    }

    public function filter()
    {
        // Lógica de filtragem para geolocalização
        $this->dispatch('filterGeoApplied', $this->geo);
    }
}
