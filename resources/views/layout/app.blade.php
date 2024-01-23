@extends('layout/html')

@section('navbar')
    @include('components/forms.navbar', ['navbar' => \App\Http\Controllers\AppController::listMenu()['navbar']]) 
@endsection

@section('sidebar')
    @include('components/forms.sidebar', [
        'consultas' => \App\Http\Controllers\ConsultaController::agrupadores(),
        'dashboard' => [
            [
                'route' => 'dashboard.nps',
                'title' => 'NPS',
            ],
            [
                'route' => 'dashboard.mrr',
                'title' => 'MRR',
            ],
        ]        
    ])
@endsection

