<form action="/aplicar-filtros" method="post">
    @csrf
    <select name="categoria">
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
        @endforeach
    </select>
    <!-- Outros campos de filtro aqui -->
    <button type="submit">Aplicar Filtros</button>
</form>
