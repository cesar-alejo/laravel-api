<x-app-layout meta-title="Files | Drive MSPS">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Files') }} [ {{ $files->count() }} ] | <a href="{{ route('files.create') }}">Nuevo</a>
        </h2>
    </x-slot>

    <div x-data="deleteFile()" x-data="{ show: true, itemId: 0 }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table>
                        <tr>
                            <th class="px-2">ID</th>
                            <th class="px-2">EXPIRATION</th>
                            <th class="px-2">NAME</th>
                            <th class="px-2">ARCHIVOS</th>
                            <th class="px-2">USER</th>
                            <th class="px-2">ACCIONES</th>
                        </tr>
                        {{-- @dump($files) --}}
                        @foreach ($files as $file)
                            <tr id="file-row-{{ $file->id }}">
                                <td class="px-2">{{ $file->id }}</td>
                                <td class="px-2">{{ $file->expiration }}</td>
                                <td class="px-2">{{ $file->name }}</td>
                                <td class="px-2">{{ $file->details_count }}</td>
                                <td class="px-2">{{ $file->user->name }}</td>
                                <td class="px-2">
                                    <x-secondary-button>
                                        {{ __('Update') }}
                                    </x-secondary-button>
                                    <x-danger-button data-id="{{ $file->id }}" data-name="{{ $file->name }}"
                                        x-on:click.prevent="open($event)">{{ __('DELETE') }}
                                    </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <x-modal-gen name="confirm-file-deletion" maxWidth="md" focusable>
            <form method="post" x-ref="form" @submit.prevent="submitForm" action="{{ route('files.destroy', 0) }}"
                class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete resourse?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    <span x-text="itemName"></span>
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="close()">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal-gen>
    </div>
    <script>
        function deleteFile() {
            return {
                show: @js($errors->userDeletion->isNotEmpty()),
                itemId: 0,
                itemName: '',
                formAction: '',
                formData: {},
                open(event) {
                    this.itemId = event.target.getAttribute('data-id');
                    this.itemName = event.target.getAttribute('data-name');
                    this.formAction = `/file/${this.itemId}`;
                    this.show = true;
                },
                close() {
                    this.itemId = 0, this.itemName = '', this.formAction = '', this.formData = {}, this.show = false;
                },
                submitForm() {
                    const url = this.formAction
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify(this.formData)
                        })
                        .then(response => response.json())
                        .then(data => {
                            const row = document.getElementById(`file-row-${this.itemId}`);
                            if (row) {
                                row.remove();
                            }
                            this.close();
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });
                }
            }
        }
    </script>
</x-app-layout>
