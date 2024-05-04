<x-app-layout title='Editar Pet'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Pet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <form action="{{ route('pets.update', $pet->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <x-input-label :value="__('Nome')" />
                        <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" value="{{ old('nome', $pet->nome) }}"/>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="descricao" :value="__('Descrição')" />
                        <x-text-input id="descricao" name="descricao" type="text" class="mt-1 block w-full" value="{{ old('descricao', $pet->descricao) }}"/>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="especie" :value="__('Espécie')" />
                        <x-text-input id="especie" name="especie" type="text" class="mt-1 block w-full" value="{{ old('especie', $pet->especie_id) }}"/>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="idadeEstimada" :value="__('Idade estimada')" />
                        <x-text-input id="idadeEstimada" name="idadeEstimada" type="text" class="mt-1 block w-full" value="{{ old('idadeEstimada', $pet->idadeEstimada) }}"/>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="porte" :value="__('Porte')" />
                        <x-text-input id="porte" name="porte" type="text" class="mt-1 block w-full" value="{{ old('porte_id', $pet->porte_id) }}"/>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="raca" :value="__('Raça')" />
                        <x-text-input id="raca" name="raca" type="text" class="mt-1 block w-full" value="{{ old('raca', $pet->raca_id) }}"/>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="user" :value="__('Nome do doador')" />
                        <x-text-input id="user" name="user" type="text" class="mt-1 block w-full" value="{{ old('user', $pet->user_id) }}"/>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="vacinas" :value="__('Vacinas')" />
                        <x-text-input id="vacinas" name="vacinas" type="text" class="mt-1 block w-full" value="{{ old('vacinas', $pet->vacinas) }}"/>
                    </div>
                    <x-primary-button type="submit">Salvar</x-primary-button>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>