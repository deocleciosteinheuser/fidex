<div class="d-flex">
    @foreach($lista as $key => $oLista)
        <input type="radio" class="btn-check" name="options" id="{{ $oLista['route'] }}" autocomplete="off" onclick="loadPage('{{ route('card.' . $oLista['route']) }}');">
        <label class="btn btn-secondary" for="{{ $oLista['route'] }}">{{ $oLista['title'] }}</label>
    @endforeach
</div>
