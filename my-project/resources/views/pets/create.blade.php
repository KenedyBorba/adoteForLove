<x-app-layout title='Cadastrar Pet'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Pet') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <x-input-label for="image" :value="__('Imagem do Pet')" />
                        <input type="file" id="image" name="image" class="from-control-file">
                    </div>
                    <div class="mb-3">
                        <x-input-label for="nome" :value="__('Nome')" />
                        <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" value="{{ old('nome') }}"/>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="descricao" :value="__('Descrição')" />
                        <x-text-input id="descricao" name="descricao" type="text" class="mt-1 block w-full" value="{{ old('descricao') }}"/>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="idadeEstimada" :value="__('Idade estimada')" />
                        <x-text-input id="idadeEstimada" name="idadeEstimada" type="text" class="mt-1 block w-full" value="{{ old('idadeEstimada') }}"/>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="porte" :value="__('Porte')" />
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="porte" name="porte" >
                            <option selected disabled >Selecionar porte</option>
                            @foreach ($portes as $porte)
                            <option value="{{ $porte->id }}">{{ $porte->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="porte" :value="__('Porte')" />
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="porte" name="porte" >
                            <option selected disabled >Selecionar porte</option>
                            @foreach ($portes as $porte)
                            <option value="{{ $porte->id }}">{{ $porte->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="genero" :value="__('Castração')" />
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="castracao" name="castracao" >
                            <option selected disabled >Selecionar castração</option>
                            <option value="Sim">Sim</option>
                            <option value="Não">Não</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="genero" :value="__('Gênero')" />
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="genero" name="genero" >
                            <option selected disabled >Selecionar gênero</option>
                            <option value="Macho">Macho</option>
                            <option value="Fêmea">Fêmea</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="especie" :value="__('Espécie')" />
                        <select  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="especie" name="especie" >
                            <option selected disabled >Selecionar espécie</option>
                            @foreach ($especies as $especie)
                            <option value="{{ $especie->id }}">{{ $especie->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="raca" :value="__('Raça')" />
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="raca" name="raca" >
                            <option selected disabled >Selecionar raça</option>
                            @foreach ($racas as $raca)
                            <option value="{{ $raca->id }}">{{ $raca->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="vacinas" :value="__('Vacinas')" />
                        <x-text-input id="vacinas" name="vacinas" type="text" class="mt-1 block w-full" value="{{ old('vacinas') }}"/>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="estado" :value="__('Estado')" />
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="estado" name="estado">
                            <option selected disabled>Selecionar estado</option>
                            @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}">{{ $estado->nome }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="mb-3">
                        <x-input-label for="cidade" :value="__('Cidade')" />
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="cidade" name="cidade"></select>
                    </div>
            
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#estado').on('change', function () {
                                var estadoId = this.value;
                                $('#cidade').html('');
                                $.ajax({
                                    url: '{{ route('cidades') }}?estado_id='+estadoId,
                                    type: 'get',
                                    success: function (res) {
                                        $('#cidade').html('<option value="">Selecionar Cidade</option>');
                                        $.each(res, function (key, value) {
                                            $('#cidade').append('<option value="' + value
                                                .id + '">' + value.nome + '</option>');
                                        });
                                    }
                                });
                            });
                        });
                    </script>

                    <x-primary-button>Cadastrar</x-primary-button>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>