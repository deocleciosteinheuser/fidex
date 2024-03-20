<?php

namespace App\Livewire;

use App\Models\Pessoa;
use Livewire\Component;

class FilterPessoa extends Component
{
    public $filterPessoa = [];

    public function render()
    {
        $pessoas = Pessoa::all();
        return view('livewire.filter-pessoa', ['pessoas' => $pessoas]);
    }

}
