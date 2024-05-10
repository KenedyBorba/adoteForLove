<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Pets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="card mt-3 mb-4 border-light shadow">
                    <div class="card-header d-flex justify-content-between">
                        <span>Pesquisar</span>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('pets.index') }}">
                            <div class="row">
    
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label" for="nome">Nome</label>
                                    <input type="text" name="nome" id="nome" class="form-control" value="{{ $nome }}" placeholder="Nome do pet" />
                                </div>
    
                                <div class="col-md-6 col-sm-6 mt-3 pt-4">
                                    <button type="submit" class="btn btn-info btn-sm">Pesquisar</button>
                                    <a href="{{ route('pets.index') }}" class="btn btn-warning btn-sm">Limpar</a>
                                </div>
    
                            </div>
    
                        </form>
                    </div>
                </div>

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

                <div class="flex items-center" style="justify-content: space-between">
                    <a href="{{ route('pets.create') }}">
                        <div style="justify-content: space-between" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Cadastrar novo pet') }}
                        </div>
                    </a>
                    {{ $pets->onEachSide(5)->links() }}
                </div>

            </div>
        </div>
    </div>

</x-app-layout>