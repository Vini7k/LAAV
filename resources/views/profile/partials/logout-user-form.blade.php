<section class="space-y-6">
    <header class="header">
        <h2 class="text-lg font-medium text-gray-200 dark:text-gray-100">
            {{ __('Sair da conta') }}
        </h2>

        <p class="mt-1 text-sm text-white dark:text-gray-400">
            {{ __('Você tem certeza de que deseja sair da sua conta? Ao fazer isso, você precisará se autenticar novamente para acessar o sistema.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-logout')"
    >{{ __('Sair') }}</x-danger-button>

    <x-modal name="confirm-logout" :show="$errors->logout->isNotEmpty()" focusable>
        <form method="post" action="{{ route('logout') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Tem certeza de que deseja sair da sua conta?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Depois de sair, você precisará fazer login novamente para acessar seu perfil e recursos.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Sair') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
