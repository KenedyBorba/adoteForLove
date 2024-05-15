<x-app-layout title='Editar Pet'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Pet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <form action="{{ route('pets.update', $pet) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <x-input-label for="image" :value="__('Imagem do Pet')" />
                        <input type="file" id="image" name="image" class="from-control-file">
                    </div>
                    <div class="mb-3">
                        <x-input-label :value="__('Nome')" />
                        <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" value="{{ old('nome', $pet->nome) }}" required/>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="descricao" :value="__('Descrição')" />
                        <x-text-input id="descricao" name="descricao" type="text" class="mt-1 block w-full" value="{{ old('descricao', $pet->descricao) }}" required/>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="idadeEstimada" :value="__('Idade estimada')" />
                        <x-text-input id="idadeEstimada" name="idadeEstimada" type="number" class="mt-1 block w-full" value="{{ old('idadeEstimada', $pet->idadeEstimada) }}" required/>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="porte" :value="__('Porte')" />
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="porte" name="porte" required>
                            <option selected disabled >Selecionar porte</option>
                            @foreach ($portes as $porte)
                            <option @if ($portesIdSelected == $porte->id) selected @endif value="{{ $porte->id }}">{{ $porte->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="genero" :value="__('Castração')" />
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="castracao" name="castracao" required>
                            <option selected disabled >Selecionar castração</option>
                            <option @if ($pet->castracao == "Sim") selected @endif value="Sim">Sim</option>
                            <option @if ($pet->castracao == "Não") selected @endif value="Não">Não</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="genero" :value="__('Gênero')" />
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="genero" name="genero" required>
                            <option selected disabled >Selecionar gênero</option>
                            <option @if ($pet->genero == "Macho") selected @endif value="Macho">Macho</option>
                            <option @if ($pet->genero == "Fêmea") selected @endif value="Fêmea">Fêmea</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="especie" :value="__('Espécie')" />
                        <select  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="especie" name="especie" required>
                            <option selected disabled >Selecionar espécie</option>
                            @foreach ($especies as $especie)
                            <option @if ($especiesIdSelected == $especie->id) selected @endif value="{{ $especie->id }}">{{ $especie->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="raca" :value="__('Raça')" />
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="raca" name="raca" required>
                            <option selected disabled >Selecionar raça</option>
                            @foreach ($racas as $raca)
                            <option @if ($racasIdSelected == $raca->id) selected @endif value="{{ $raca->id }}">{{ $raca->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-input-label :value="__('Vacinas')" />
                        <x-text-input id="vacinas" name="vacinas" type="text" class="mt-1 block w-full" value="{{ old('vacinas', $pet->vacinas) }}" required/>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="estado" :value="__('Estado')" />
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="estado" name="estado" required>
                            <option selected disabled >Selecionar estado</option>
                            @foreach ($estados as $estado)
                            <option @if ($estadoIdSelected == $estado->id) selected @endif value="{{ $estado->id }}">{{ $estado->nome }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="mb-3">
                        <x-input-label for="cidade" :value="__('Cidade')" />
                        @if ($cidades)
                            <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="cidade" name="cidade" required>
                                <option selected disabled >Selecionar cidade</option>
                                @foreach ($cidades as $cidade)
                                    <option @if ($cidadeIdSelected == $cidade->id) selected @endif value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
                                @endforeach
                            </select>
                        @else
                            <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="cidade" name="cidade" required></select>
                        @endif
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




                    <x-primary-button type="submit">Salvar</x-primary-button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>