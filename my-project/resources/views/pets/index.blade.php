<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Pets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="mb-3" style="justify-content: space-between; position: absolute;">
                    <a href="{{ route('pets.create') }}">
                        <div style="justify-content: space-between" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Cadastrar novo pet') }}
                        </div>
                    </a>
                </div>

                <div class="mb-3" style="justify-content: space-between">
                    @if(request()->route()->getName() == 'pets.index')
                        <form action="{{ route('pets.index') }}">
                    @else
                        <form action="{{ route('pets.myPets') }}">
                    @endif
                    
                        <div id="mostrar-conteudo" class="mb-3" style="display: grid; justify-items: end;">
                            <div  style="cursor: pointer; justify-content: space-between" class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs text-black uppercase tracking-widest ">
                                <img src="img/icon/filter2.png" style="width: 12px; height: 12px;" class=""><span style="margin-left: 5px;" class="font-semibold">{{ __('Filtro') }}</span>
                            </div>
                        </div>
                
                        <div id="conteudo" class="hidden">
                            <div class="mb-3">
                                <div class="card mt-3 mb-4 border-light shadow">
                
                                    <div class="card-body">
                                        @if(request()->route()->getName() == 'pets.index')
                                            <form action="{{ route('pets.index') }}">
                                        @else
                                            <form action="{{ route('pets.myPets') }}">
                                        @endif
                                                <div class="mb-3">
                                                    <x-input-label for="nome">Nome</x-input-label>
                                                    <x-text-input type="text" name="nome" id="nome" class="mt-1 block w-full" value="{{ $nome }}" placeholder="Nome do pet" />
                                                </div>
                    
                                                <div class="mb-3">
                                                    <x-input-label for="especie_id" :value="__('Espécie')" />
                                                    <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="especie_id" name="especie_id" >
                                                        <option selected disabled >Selecionar Espécie</option>
                                                        @foreach ($especiesId as $especie)
                                                        <option @if ($especie_id == $especie->id) selected @endif value="{{ $especie->id }}">{{ $especie->nome }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                    
                                                <div class="mb-3">
                                                    <x-input-label for="estado_id" :value="__('Estado')" />
                                                    <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="estado_id" name="estado_id" >
                                                        <option selected disabled >Selecionar estado</option>
                                                        @foreach ($estados as $estado)
                                                        <option @if ($estado_id == $estado->id) selected @endif value="{{ $estado->id }}">{{ $estado->nome }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>



                                                <div class="mb-3">
                                                    <x-input-label for="cidadeId" :value="__('Cidade')" />
                                                    @if ($cidades)
                                                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="cidadeId" name="cidadeId">
                                                            <option selected disabled >Selecionar cidade</option>
                                                            @foreach ($cidades as $cidade)
                                                                <option @if ($cidadeId == $cidade->id) selected @endif value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="cidadeId" name="cidadeId"></select>
                                                    @endif
                                                </div>
                                        
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $('#estado_id').on('change', function () {
                                                            var estadoId = this.value;
                                                            $('#cidadeId').html('');
                                                            $.ajax({
                                                                url: '{{ route('cidades') }}?estado_id='+estadoId,
                                                                type: 'get',
                                                                success: function (res) {
                                                                    $('#cidadeId').html('<option value="">Selecionar Cidade</option>');
                                                                    $.each(res, function (key, value) {
                                                                        $('#cidadeId').append('<option value="' + value
                                                                            .id + '">' + value.nome + '</option>');
                                                                    });
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>
                    
                                                @if(request()->route()->getName() == 'pets.index')
                                                    <button type="submit" class="btn btn-sm bg-gray-800 text-white" style="background-color:rgb(21, 108, 223);">Pesquisar</button>
                                                    <a href="{{ route('pets.index') }}" class="btn btn-warning btn-sm font-semibold">Limpar</a>
                                                @else
                                                    <button type="submit" class="btn btn-sm bg-gray-800 text-white" style="background-color:rgb(21, 108, 223);">Pesquisar</button>
                                                    <a href="{{ route('pets.myPets') }}" class="btn btn-warning btn-sm font-semibold">Limpar</a>
                                                @endif

                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                

                <script>
                    $(document).ready(function(){
                        $("#mostrar-conteudo").click(function(){
                            $("#conteudo").slideToggle();
                        });
                    });
                </script>

                @forelse ($pets as $petIndex => $pet)
                    @if ($petIndex % 2 === 0)
                        <div class="row">
                    @endif
                    
                    <div class="col-md-6">
                        <a href="{{ route('pets.show', $pet->id) }}" style="text-decoration: none; color: inherit;">
                            <div class="card mb-3 px-2 py-2 bg-gray-800 border border-transparent rounded-md text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" style="width: 570px; height: auto; min-height: 150px; flex-grow: 1; margin: 0 0px;">
                                <div class="row g-0">
                                    <div class="col-md-5" style="">
                                        <img src="/{{ $pet->image }}" class="rounded-md" style="width: 200px; height: 200px; object-fit: cover;">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-title font-bold">{{ $pet->nome }}</h5>
                                            <p class="card-text text-xs">{{ Str::limit($pet->descricao, 150) }}</p>
                                            <p class="card-text text-xs"><small class="text-body-secondary">{{ $pet->idadeEstimada }} ano(s)</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    @if ($petIndex % 2 === 1)
                        </div>
                    @endif
                    @empty
                    <div class="mb-2">
                        <span>Nenhum Pet Cadastrado</span>
                    </div>
                @endforelse

                <div class="col-md-12" style="display: flex; justify-content: flex-end; margin-left: 0;">
                    {{ $pets->onEachSide(5)->links() }}
                </div>

            </div>
        </div>
    </div>

</x-app-layout>