<x-app-layout title='Cadastrar Pet'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Pet') }}
        </h2>

        @if($errors->any())
            <span style="color: #ff0000;">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </span>
            <br>
        @endif
        <br>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <form action="{{ route('pets.store') }}" method="POST">
                    @csrf
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
                        <select class="mt-1 block w-full rounded-md" id="porte" name="porte" >
                            <option selected disabled >Selecionar Porte</option>
                            @foreach ($portes as $porte)
                            <option value="{{ $porte->id }}">{{ $porte->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="especie" :value="__('Espécie')" />
                        <select class="mt-1 block w-full rounded-md" id="especie" name="especie" >
                            <option selected disabled >Selecionar Espécie</option>
                            @foreach ($especies as $especie)
                            <option value="{{ $especie->id }}">{{ $especie->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="raca" :value="__('Raça')" />
                        <select class="mt-1 block w-full rounded-md" id="raca" name="raca" >
                            <option selected disabled >Selecionar Raça</option>
                            @foreach ($racas as $raca)
                            <option value="{{ $raca->id }}">{{ $raca->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="vacinas" :value="__('Vacinas')" />
                        <x-text-input id="vacinas" name="vacinas" type="text" class="mt-1 block w-full" value="{{ old('vacinas') }}"/>
                    </div>




                    <x-primary-button>Cadastrar</x-primary-button>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>