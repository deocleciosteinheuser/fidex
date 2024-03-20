<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($agrupador['title']) }}
        </h2>
    </x-slot>

    <x-slot name="link">
        <!-- Bootstrap CSS -->
        <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"-->
        <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"-->
        <!-- Bootstrap-table CSS -->
        <!--link href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css" rel="stylesheet"-->
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @php
                    $url = route($agrupador['route'] . '.dados', ['dados' => 'json'])
                @endphp
                <x-consulta.consulta :agrupador="$agrupador" url="{{ $url }}" >
                </x-consulta.consulta>
            </div>
        </div>
    </div>
    <x-slot name="script">
    </x-slot>
</x-app-layout>


