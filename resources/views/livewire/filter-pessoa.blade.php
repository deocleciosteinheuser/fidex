<div class="d-flex">
    <label for="pessoa">Pessoas:</label>
    <select wire:model="filterPessoa" class="form-select" data-live-search="true" id="pessoa" multiple>
        <option value=""> All </option>
        @foreach($pessoas as $pessoa)
            <option value="{{ $pessoa->id }}"> {{ $pessoa->nome }} </option>
        @endforeach
    </select>
</div>
