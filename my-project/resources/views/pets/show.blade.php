<x-app-layout title='Visualizar Pet'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visualizar Pet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-6">
                    <div class="flex-shrink-0 w-72">
                            <img src="/{{ $pet->image }}" class="border rounded-md" style="width: 300px; height: 300px; object-fit: cover;">

                        @if ($doador->id == $user_id)
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
                        @endif
                        
                     </div>

                     <div class="mt-6 lg:mt-0">
                        <h2 class="text-lg font-medium text-gray-900"><strong>Nome:</strong> {{ $pet->nome }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Descrição:</strong> {{ $pet->descricao }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Idade Estimada:</strong> {{ $pet->idade_estimada }} ano(s)</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Porte:</strong> {{ $porte->nome }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Situação das vacinas:</strong> {{ $pet->vacinas }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Espécie:</strong> {{ $especie->nome }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Raça:</strong> {{ $raca->nome }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Gênero:</strong> {{ $pet->genero }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Castração:</strong> {{ $pet->castracao }}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Estado:</strong> {{ $estado->nome}}</h2>
                        <h2 class="text-lg font-medium text-gray-900"><strong>Cidade:</strong> {{ $cidade->nome}}</h2>

                        @if ($user_id)
                            <a href="{{ route('chat.show', $doador->id) }}">
                                <div class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('CONVERSAR COM DOADOR') }}
                                </div>
                            </a>
                        @endif

                        <x-primary-button id="exibir-alerta" class="mt-1">INFORMAÇÕES PARA CONTATO</x-primary-button>

                        <script>
                            // Adicione um listener de evento de clique ao botão usando jQuery
                            $(document).ready(function() {
                                $('#exibir-alerta').click(function() {
                                    // Exibe o SweetAlert2 quando o botão é clicado
                                    Swal.fire({
                                        html: '<h2 class="font-bold text-xl text-gray-800 leading-tight mb-1"><strong>Dados do doador:</strong></h2><h2 class="text-lg font-medium text-gray-900">{{ $doador->name }}</h2><h2 class="text-lg font-medium text-gray-900">{{ $telefone }}</h2><h2 class="text-lg font-medium text-gray-900">{{ $doador->email }}</h2>',
                                        confirmButtonText: 'Entendi', // Texto do botão padrão
                                        confirmButtonColor: '#212529',
                                        customClass: {
                                            confirmButton: 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>