<div>
    <div>
        @include('components.forms.select', [
            'id' => 'geo',
            'name' => 'geo',
            'label' => 'Geo',
            'options' => $geos,
            'selectedValues' => $filterGeo,
            'wireModel' => 'filterGeo',
            'multiple' => true,
            'todos' => true,
        ])
    </div>
    <div>
        @include('components.forms.select', [
            'id' => 'pessoa',
            'name' => 'pessoa',
            'label' => 'Pessoa',
            'options' => $pessoas,
            'selectedValues' => $filterPessoa,
            'wireModel' => 'filterPessoa',
            'multiple' => true,
            'todos' => true,
        ])
    </div>
    <div>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" wire:model="search" placeholder="Search items...">
        <button wire:click="submitFilters" class="btn btn-primary" type="submit">Filter</button>
        <button wire:click="resetFilters" class="btn btn-primary" type="button">Reset</button>
    </div>
    </form>
    Livewire
    <!-- Mensagem de sucesso após a aplicação dos filtros -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>
