<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($agrupador['title']) }}
        </h2>
    </x-slot>
    <x-slot name="link">
        <!-- Bootstrap CSS -->
        <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"-->
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-1 gap-2 p-2">
                    <livewire:filter-component/>
                    <livewire:card-nps :agrupador="$agrupador['route']">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
