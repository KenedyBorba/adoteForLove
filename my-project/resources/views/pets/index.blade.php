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

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Idade Estimada</th>
                        <th>Porte</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pets as $pet)
                        <tr>
                            <td>{{ $pet->nome }}</td>
                            <td>{{ $pet->descricao }}</td>
                            <td>{{ $pet->idadeEstimada }}</td>
                            <td style="display: flex;">
                                <x-primary-button>
                                    <a href="{{ route('pets.show', $pet->id) }}">Visualizar</a>
                                </x-primary-button>&nbsp;
                            </td>
                        </tr>
                    @empty
                        <span>Nenhum Pet Cadastrado</span>
                    @endforelse
                </tbody>
            </table>

            <x-nav-link class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" :href="route('pets.create')">
                {{ __('Cadastrar novo pet') }}
            </x-nav-link>

            {{ $pets->onEachSide(5)->links() }}

            </div>
        </div>
    </div>

</x-app-layout>