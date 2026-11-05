<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Header Section -->
            <div class="mb-8 bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-6 rounded-lg shadow">
                <h3 class="text-2xl font-bold">{{ __('Welcome back,') }} {{ Auth::user()->name }}!</h3>
                <p class="text-indigo-100 mt-1">{{ __('Manage your companies, members, and shortened links directly from this console.') }}</p>
            </div>

            <!-- Stats/Navigation Cards Grid Grid system auto handles resizing -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Card 1: Companies -->
                @can('companies.view')
                <div class="bg-white overflow-hidden shadow sm:rounded-lg transition hover:shadow-md border border-gray-100 flex flex-col justify-between">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-indigo-100 rounded-md text-indigo-600">
                                <!-- Company Icon SVG -->
                                <svg class="h-6 w-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0V11m0 0h4m-4 0h-4m4 0v4m0 0h4m-4 0h-4m4 0v4m0 0h4m-4 0h-4" />
                                </svg>
                            </div>
                            <div class="ms-4">
                                <h4 class="text-lg font-semibold text-gray-900">{{ __('Companies') }}</h4>
                                <p class="text-sm text-gray-500 mt-1">{{ __('Manage and review registered corporate platforms.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center text-sm">
                        <span class="text-gray-400 text-xs">{{ __('Corporate View Active') }}</span>
                        <a href="{{ route('companies.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500 flex items-center gap-1 transition">
                            {{ __('View All') }} &rarr;
                        </a>
                    </div>
                </div>
                @endcan

                <!-- Card 2: Members -->
                @can('members.view')
                <div class="bg-white overflow-hidden shadow sm:rounded-lg transition hover:shadow-md border border-gray-100 flex flex-col justify-between">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-md text-green-600">
                                <!-- Members/Users Icon SVG -->
                                <svg class="h-6 w-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ms-4">
                                <h4 class="text-lg font-semibold text-gray-900">{{ __('Members') }}</h4>
                                <p class="text-sm text-gray-500 mt-1">{{ __('Monitor user profiles, hierarchy, and system allocations.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center text-sm">
                        <span class="text-gray-400 text-xs">{{ __('Staff Controls Active') }}</span>
                        <a href="{{ route('members.index') }}" class="font-medium text-green-600 hover:text-green-500 flex items-center gap-1 transition">
                            {{ __('View All') }} &rarr;
                        </a>
                    </div>
                </div>
                @endcan

                <!-- Card 3: URLs -->
                @can('url.view')
                <div class="bg-white overflow-hidden shadow sm:rounded-lg transition hover:shadow-md border border-gray-100 flex flex-col justify-between">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-amber-100 rounded-md text-amber-600">
                                <!-- URL Link/Shortener Icon SVG -->
                                <svg class="h-6 w-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </div>
                            <div class="ms-4">
                                <h4 class="text-lg font-semibold text-gray-900">{{ __('URLs & Metrics') }}</h4>
                                <p class="text-sm text-gray-500 mt-1">{{ __('Inspect redirection metrics, hit counts, and active links.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center text-sm">
                        <span class="text-gray-400 text-xs">{{ __('Tracking Systems Active') }}</span>
                        <a href="{{ route('urls.index') }}" class="font-medium text-amber-600 hover:text-amber-500 flex items-center gap-1 transition">
                            {{ __('View All') }} &rarr;
                        </a>
                    </div>
                </div>
                @endcan

            </div>

        </div>
    </div>
</x-app-layout>
