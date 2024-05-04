<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informação do Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Atualize as informações de perfil e endereço de e-mail da sua conta.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="telefone" :value="__('Telefone')" />
            <x-text-input id="telefone" name="telefone" type="text" class="mt-1 block w-full" :value="old('telefone', $user->telefone)" />
            <x-input-error class="mt-2" :messages="$errors->get('telefone')" />
        </div>

        <div>
            <x-input-label for="data_nascimento" :value="__('Data Nascimento')" />
            <x-text-input id="data_nascimento" name="data_nascimento" type="date" class="mt-1 block w-full" :value="old('data_nascimento', $user->data_nascimento)" />
            <x-input-error class="mt-2" :messages="$errors->get('data_nascimento')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Seu endereço de e-mail não foi verificado.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Um novo link de verificação foi enviado para seu endereço de e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        
        <!-- endereco -->

        <div>
            <x-input-label for="logradouro" :value="__('Logradouro')" />
            <x-text-input id="logradouro" name="logradouro" type="text" class="mt-1 block w-full" :value="old('logradouro', optional($endereco)->logradouro)" />
            <x-input-error class="mt-2" :messages="$errors->get('logradouro')" />
        </div>

        <div>
            <x-input-label for="numero" :value="__('Número')" />
            <x-text-input id="numero" name="numero" type="text" class="mt-1 block w-full" :value="old('numero', optional($endereco)->numero)" />
            <x-input-error class="mt-2" :messages="$errors->get('numero')" />
        </div>

        <div>
            <x-input-label for="bairro" :value="__('Bairro')" />
            <x-text-input id="bairro" name="bairro" type="text" class="mt-1 block w-full" :value="old('bairro', optional($endereco)->bairro)" />
            <x-input-error class="mt-2" :messages="$errors->get('bairro')" />
        </div>

        <div class="mb-3">
            <x-input-label for="estado" :value="__('Estado')" />
            <select class="mt-1 block w-full rounded-md" id="estado" name="estado" >
                <option selected disabled >Selecionar estado</option>
                @foreach ($estados as $estado)
                <option @if ($estadoIdSelected == $estado->id) selected @endif value="{{ $estado->id }}">{{ $estado->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">

            <x-input-label for="cidade" :value="__('Cidade')" />
            @if ($cidades)
                <select class="mt-1 block w-full rounded-md" id="cidade" name="cidade" >
                    <option selected disabled >Selecionar cidade</option>
                    @foreach ($cidades as $cidade)
                    <option @if ($cidadeIdSelected == $cidade->id) selected @endif value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
                    @endforeach
                </select>
            @else
                <select class="mt-1 block w-full rounded-md" id="cidade" name="cidade" ></select>
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

        <!-- fim endereco -->

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Salvo.') }}</p>
            @endif
        </div>
    </form>
</section>
