<div class="grid grid-cols-1 grid-rows-auto gap-x-2 gap-y-2">
    <div class="grid grid-cols-2 gap-4">
        @include('components.forms.select', [
            'id' => 'geo',
            'name' => 'geo',
            'label' => 'Geo',
            'options' => $geos,
            'selectedValues' => $filterGeo,
            'wireModel' => 'filterGeo',
            'multiple' => true
        ])
        @include('components.forms.select', [
            'id' => 'pessoa',
            'name' => 'pessoa',
            'label' => 'Pessoa',
            'options' => $pessoas,
            'selectedValues' => $filterPessoa,
            'wireModel' => 'filterPessoa',
            'multiple' => true
        ])
    </div>

    <div class="input-group mb-3 col-span-2">
        <input type="text" class="form-control" wire:model="search" placeholder="Search items...">
        <button wire:click="submitFilters" wire:loading.attr="disabled" class="btn btn-primary" type="submit" >
            Filter
        </button>
        <button wire:click="resetFilters" wire:loading.attr="disabled" class="btn btn-primary" type="button">Reset</button>
    </div>
    </form>
    <!-- Mensagem de sucesso após a aplicação dos filtros -->
    @if (session()->has('message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    @endif
    <div wire:loading wire:target="submitFilters" class="modal fade">
    </div>
</div>
