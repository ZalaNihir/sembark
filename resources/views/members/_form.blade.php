<div class="space-y-8">
    <div>
        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2 mb-6">
            {{ __('Member Information') }}
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
            <div>
                <x-input-label for="name" :value="__('Member Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name', $member?->name)" required autofocus autocomplete="organization" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Member Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                    :value="old('email', $member?->email)" required autocomplete="email"  :readonly="$member ? true : false" :required="!$member" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" name="phone_number" type="text" class="mt-1 block w-full"
                    :value="old('phone', $member?->phone_number)" autocomplete="tel" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
        <a href="{{ route('members.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Cancel') }}
        </a>

        <x-primary-button>{{ $buttonText ?? __('Save') }}</x-primary-button>
    </div>
</div>
