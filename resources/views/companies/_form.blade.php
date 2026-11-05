<div class="space-y-8">

    <!-- SECTION 1: COMPANY INFORMATION -->
<!-- _form.blade.php ka top section -->
<div class="space-y-8">

    <!-- SECTION 1: COMPANY INFORMATION -->
    <div>
        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2 mb-6">
            {{ __('Company Information') }}
        </h3>

        <!-- Yahan sm: grid active kiya hai taaki choti screens par bhi columns side-by-side aayein -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
            <!-- Company Name -->
            <div>
                <x-input-label for="name" :value="__('Company Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name', $company?->name)" required autofocus autocomplete="organization" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Company Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                    :value="old('email', $company?->email)" required autocomplete="email"  :readonly="$company ? true : false" :required="!$company" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <!-- Phone Number -->
            <div>
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                    :value="old('phone', $company?->phone)" autocomplete="tel" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>
        </div>

        <!-- Row 2: Database, Address & Description -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <div>
                <x-input-label for="address" :value="__('Address')" />
                <textarea id="address" name="address" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('address', $company?->address) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('description', $company?->description) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>
        </div>
    </div>

    @if(empty($company))
    <div class="pt-4">
        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2 mb-6">
            {{ __('Company Admin (User) Account') }}
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <x-input-label for="user_name" :value="__('Admin Name')" />
                <x-text-input id="user_name" name="user_name" type="text" class="mt-1 block w-full"
                    :value="old('user_name')" required autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('user_name')" />
            </div>

            <div>
                <x-input-label for="user_email" :value="__('Admin Email Address')" />
                <x-text-input id="user_email" name="user_email" type="email" class="mt-1 block w-full"
                    :value="old('user_email')" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('user_email')" />
            </div>
        </div>
    </div>
    @endif

    <!-- ACTION BUTTONS -->
    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
        <a href="{{ route('companies.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Cancel') }}
        </a>

        <x-primary-button>{{ $buttonText ?? __('Save') }}</x-primary-button>
    </div>
</div>
