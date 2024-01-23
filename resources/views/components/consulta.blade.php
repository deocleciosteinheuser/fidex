@extends('layout/app')

@section('title')
    {{$agrupador['title']}}
@endsection

@section('content')
    @php
       $url = route($agrupador['route'] . '.dados', ['dados' => 'json'])   
    @endphp
    <x-consulta.consulta :agrupador="$agrupador" url="{{ $url }}" >
    </x-consulta.consulta>             
@endsection
