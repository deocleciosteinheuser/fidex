<?php

namespace App\Livewire;

use App\Models\GeoLocalizacao;
use Livewire\Component;

class FilterGeo extends Component
{
    public $filterGeo;

    public function render()
    {
        $geos = GeoLocalizacao::all();
        return view('livewire.filter-geo', ['geos' => $geos]);
    }

}
