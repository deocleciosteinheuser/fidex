
<div class="d-flex flex-wrap">
    @endphp
        <div class="card">
            <h5 class="card-header">Zonas</h5>
            <div class="card-body">
                @php
                    $aDados = (new \App\Http\Controllers\ConsultaController())->json();
                @endphp
                @foreach ($aDados as $key => $oDado)
                    <x-card-zona
                        header="{{ $oDado->agrupador }}"
                        notaNps="{{ $oDado->nota_nps }}"
                        key="zona{{ $key }}"
                    />
                @endforeach
            </div>
        </div>
</div>
