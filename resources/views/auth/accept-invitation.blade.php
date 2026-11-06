<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Set a password for your Sembark account, {{ $user->name }}.
    </div>

    <form method="POST" action="{{ URL::temporarySignedRoute('invitation.store', now()->addDays(7), ['user' => $user->getKey()]) }}">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autofocus autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="mt-1 block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4 flex items-center justify-end">
            <x-primary-button>{{ __('Set Password') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
