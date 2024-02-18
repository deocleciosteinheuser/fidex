@extends('layout/html')

@section('sidebar')
    @include('components/forms.sidebar', [
        'consultas' => \App\Http\Controllers\ConsultaController::agrupadores(),
        'customers' => App\Models\Pessoa::all('nome'),
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

