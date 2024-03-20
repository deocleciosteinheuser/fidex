<div class="d-flex">
    <label for="geo">Geolocalização:</label>
    <select class="form-select" id="geo" wire:model="geo">
        <option value=""> All </option>
        @foreach($geos as $geo)
            <option value="{{ $geo->id }}"> {{ $geo->nome }} </option>
        @endforeach
    </select>
</div>

