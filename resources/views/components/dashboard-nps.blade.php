@extends('layout/app')

@section('title')
    NPS
@endsection

@section('content')

@php
$aDados = (new \App\Http\Controllers\ConsultaUsuarioController())->json();
@endphp

<div class="d-flex flex-wrap">
    @foreach ($aDados as $key => $oDado)
        <x-card-nps
            username="{{ $oDado->agrupador }}"
            detractorCount="{{ $oDado->respostas_detrator }}"
            detractorPercentage="{{ $oDado->detrator }}"
            neutralCount="{{ $oDado->respostas_neutro }}"
            neutralPercentage="{{ $oDado->neutro }}"
            promoterCount="{{ $oDado->respostas_promotor }}"
            promoterPercentage="{{ $oDado->promotor }}"
            totalCount="{{ $oDado->total_resposta }}"
            notaNps="{{ $oDado->nota_nps }}"
            key="{{ $key }}"
        />
    @endforeach
</div>
@endsection
