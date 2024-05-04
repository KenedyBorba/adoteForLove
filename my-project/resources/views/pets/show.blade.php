<x-app-layout title='Visualizar Pet'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visualizar Pet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                Nome: {{ $pet->nome }}<br>
                Descrição: {{ $pet->descricao }}<br>
                Idade Estimada: {{ $pet->idadeEstimada }}<br>
                Vacinas: {{ $pet->vacinas }}<br>
                Porte: {{ $pet->porte_id}}

                <x-primary-button type="button">
                    <a href="{{ route('pets.edit', $pet->id) }}">Editar</a>
                </x-primary-button>&nbsp;
                
                <form action="{{ route('pets.destroy', $pet->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-primary-button>Apagar</x-primary-button>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>