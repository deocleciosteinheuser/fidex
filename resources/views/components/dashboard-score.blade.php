
<div class="d-flex flex-wrap">
    @php
        $aDados = (new \App\Http\Controllers\ConsultaController())->json();
    @endphp

    @foreach ($aDados as $key => $oDado)
        <x-card-score
            header="{{ $oDado->agrupador }}"
            detractorPercentage="{{ $oDado->detrator }}"
            neutralPercentage="{{ $oDado->neutro }}"
            promoterPercentage="{{ $oDado->promotor }}"
            notaNps="{{ $oDado->nota_nps }}"
            key="score{{ $key }}"
        />
    @endforeach
        <div class="card">
            <h5 class="card-header">Clientes</h5>
            <div class="card-body">
                @php
                    $aDados = (new \App\Http\Controllers\ConsultaClienteController())->order('nota_nps')->limit(1)->json();
                @endphp
                @foreach ($aDados as $key => $oDado)
                    <x-card-score
                        header="Bad Cliente - {{ $oDado->agrupador }}"
                        detractorPercentage="{{ $oDado->detrator }}"
                        neutralPercentage="{{ $oDado->neutro }}"
                        promoterPercentage="{{ $oDado->promotor }}"
                        notaNps="{{ $oDado->nota_nps }}"
                        key="badcliente"
                    />
                @endforeach
            </div>
        </div>
</div>
