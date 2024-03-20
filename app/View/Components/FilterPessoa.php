<?php

namespace App\Livewire;

use App\Models\Pessoa;
use Livewire\Component;

class FilterPessoa extends Component
{
    public $pessoa;

    public function render()
    {
        $pessoas = Pessoa::all();
        return view('livewire.filter-pessoa', ['pessoas' => $pessoas]);
    }

    public function filter()
    {
        // Lógica de filtragem para pessoas
        $this->dispatch('filterPessoaApplied', $this->pessoa);
    }
}
