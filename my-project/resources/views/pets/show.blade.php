<x-app-layout title='Visualizar Pet'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visualizar Pet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="items-center align-items-center">
                    <div style="padding-right: 20px; float: left; width: 300px;">
                        <img src="/{{ $pet->image }}" class="border rounded-md" style="width: 300px; height: 300px; object-fit: cover;">

                        <div class="flex items-center mt-3">
                            <a href="{{ route('pets.edit', $pet->id) }}">
                                <div class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Editar') }}
                                </div>
                            </a>&nbsp;
                            
                            <form action="{{ route('pets.destroy', $pet->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-primary-button>Apagar</x-primary-button>
                            </form>
                        </div>

                    </div>
                    <div style="margin-left: 330px; width: 800px;">
                        <h2 class="text-lg font-medium text-gray-900"><strong>Nome:</strong> {{ $pet->nome }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Descrição:</strong> {{ $pet->descricao }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Idade Estimada:</strong> {{ $pet->idadeEstimada }} ano(s)</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Porte:</strong> {{ $porte->nome }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Situação das vacinas:</strong> {{ $pet->vacinas }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Espécie:</strong> {{ $especie->nome }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Raça:</strong> {{ $raca->nome }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Gênero:</strong> {{ $pet->genero }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Castração:</strong> {{ $pet->castracao }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Estado:</strong> {{ $estado->nome}}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Cidade:</strong> {{ $cidade->nome}}</h2>
                        <h2 class="text-lg font-medium text-gray-900 mt-1"><strong>Dados do doador:</strong></h2>
                        <h2 class="text-lg font-medium text-gray-900">{{ $doador->name }}</h2>
                        <h2 class="text-lg font-medium text-gray-900">{{ $doador->telefone }}</h2>
                        <h2 class="text-lg font-medium text-gray-900">{{ $doador->email }}</h2>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>