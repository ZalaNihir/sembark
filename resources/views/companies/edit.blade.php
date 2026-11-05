<!-- create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Ise max-w-7xl karein taaki grid columns ko failne ki poori jagah mile -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="post" action="{{ route('companies.update', $company) }}">
                        @csrf
                        @method('PUT')

                        @include('companies._form', [
                            'buttonText' => 'Update Company',
                            'company' => $company
                        ])

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
