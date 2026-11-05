<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('URLs') }}
            </h2>

            <x-primary-button type="button" onclick="openModal()">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                {{ __('Add URL') }}
            </x-primary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        URL </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Shortened URL </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Clicks </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions </th>
                                </tr>
                            </thead>
                            <tbody id="url-table-body" class="bg-white divide-y divide-gray-200">
                                @forelse ($urls as $url)
                                    <tr id="url-row-{{ $url->id }}"
                                        class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $url->original_url }} </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ url($url->short_code) }} </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $url->counts }} </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <!-- AJAX Edit ke liye href ko badla aur preventDefault lagaya -->
                                            <a href="#"
                                                onclick="event.preventDefault(); openModal({{ $url->id }}, '{{ route('urls.edit', $url) }}')"
                                                class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                            <form action="{{ route('urls.destroy', $url) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="no-urls-row">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                            colspan="4"> No URLs found. </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $urls->links() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="url-modal" focusable>
        <form id="url-form" method="post" action="{{ route('urls.store') }}" class="p-6">
            @csrf
            <div id="method-container"></div>

            <h2 id="modal-title" class="text-lg font-medium text-gray-900">{{ __('Add New URL') }}</h2>

            <div class="mt-6">
                <x-input-label for="original_url" value="{{ __('Original URL') }}" />
                <x-text-input id="original_url" name="original_url" type="url" class="mt-1 block w-full"
                    placeholder="https://example.com" required />
                <span class="text-red-600 text-sm mt-2 hidden" id="error-original_url"></span>
            </div>

            <div class="mt-4">
                <x-input-label for="short_code" value="{{ __('Custom Short Code (Optional)') }}" />
                <x-text-input id="short_code" name="short_code" type="text" class="mt-1 block w-full"
                    placeholder="e.g., my-link" />
                <span class="text-red-600 text-sm mt-2 hidden" id="error-short_code"></span>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button type="button"
                    x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <x-primary-button id="submit-btn" class="ms-3" type="submit">{{ __('Save URL') }}</x-primary-button>
            </div>
        </form>
    </x-modal>

    <script>
        function openModal(id = null, editUrl = null) {
            const form = document.getElementById('url-form');
            const title = document.getElementById('modal-title');
            const submitBtn = document.getElementById('submit-btn');
            const methodContainer = document.getElementById('method-container');

            document.getElementById('error-original_url').classList.add('hidden');
            document.getElementById('error-short_code').classList.add('hidden');
            form.reset();

            if (id && editUrl) {
                title.innerText = "{{ __('Edit URL') }}";
                submitBtn.innerText = "{{ __('Update URL') }}";

                form.action = editUrl.replace('/edit', '');

                methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';

                fetch(editUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(response => {
                        if (response.success && response.data) {
                            document.getElementById('original_url').value = response.data.original_url;
                            document.getElementById('short_code').value = response.data.short_code || '';

                            window.dispatchEvent(new CustomEvent('open-modal', {
                                detail: 'url-modal'
                            }));
                        }
                    });
            } else {
                title.innerText = "{{ __('Add New URL') }}";
                submitBtn.innerText = "{{ __('Save URL') }}";
                form.action = "{{ route('urls.store') }}";
                methodContainer.innerHTML = '';

                window.dispatchEvent(new CustomEvent('open-modal', {
                    detail: 'url-modal'
                }));
            }
        }

        document.getElementById('url-form').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            const originalUrlError = document.getElementById('error-original_url');
            const shortCodeError = document.getElementById('error-short_code');

            originalUrlError.classList.add('hidden');
            shortCodeError.classList.add('hidden');

            originalUrlError.innerText = '';
            shortCodeError.innerText = '';

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(async response => {
                    const data = await response.json();

                    if (response.status === 422) {

                        if (data.errors?.original_url) {
                            originalUrlError.innerText = data.errors.original_url[0];
                            originalUrlError.classList.remove('hidden');
                        }

                        if (data.errors?.short_code) {
                            shortCodeError.innerText = data.errors.short_code[0];
                            shortCodeError.classList.remove('hidden');
                        }

                        return;
                    }

                    if (!response.ok) {
                        throw new Error(data.message || 'Something went wrong!');
                    }

                    // Success
                    if (data.success) {
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert(error.message || 'Something went wrong!');
                });
        });
    </script>
</x-app-layout>
