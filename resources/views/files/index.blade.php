<x-app-layout meta-title="Files | Drive MSPS">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Files') }} [ {{ $files->count() }} ] | <a href="{{ route('files.create') }}">Nuevo</a>
        </h2>
    </x-slot>

    <div x-data="actionFile()" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table>
                        <tr>
                            <th class="px-2 border-y border-sky-500"></th>
                            <th class="px-2 border-y border-sky-500">RESOURSE</th>
                            <th class="px-2 border-y border-sky-500">EXPIRATION</th>
                            <th class="px-2 border-y border-sky-500">NAME</th>
                            <th class="px-2 border-y border-sky-500">ARCHIVOS</th>
                            <th class="px-2 border-y border-sky-500">USER</th>
                            <th class="px-2 border-y border-sky-500">DETAILS</th>
                        </tr>
                        {{-- @dump($files) --}}
                        @foreach ($files as $file)
                            <tr id="file-row-{{ $file->id }}">
                                <td class="px-2 pt-1">
                                    <x-secondary-button isIcon="true" x-on:click="formData.itemId++;">
                                        <i class="material-icons">edit_square</i>
                                    </x-secondary-button>
                                    <x-danger-button data-id="{{ $file->id }}" data-name="{{ $file->name }}"
                                        isIcon="true" x-on:click.prevent="open($event)">
                                        <i class="material-icons">delete_forever</i>
                                    </x-danger-button>
                                </td>
                                <td class="table-cell text-center font-bold px-2">
                                    <x-table-link href="#" active="1"
                                        x-on:click.prevent="$dispatch('open-modal', {
                                            name: 'sub-m',
                                            title: 'Recurso No. {{ $file->id }}',
                                            id:{{ $file->id }},
                                            active: '{{ __('Details') }}',
                                            main: [
                                                { url: '{{ route('files.show', (int) $file->id, false) }}', text:'{{ __('Details') }}' },
                                                { url: '{{ route('files.attach', (int) $file->id, false) }}', text:'{{ __('Files') }}' },
                                                { url: '{{ route('files.recip', (int) $file->id, false) }}', text:'{{ __('Recipients') }}' },
                                                { url: '{{ route('files.history', (int) $file->id, false) }}', text:'{{ __('History') }}' }
                                            ]
                                        })">{{ $file->id }}
                                    </x-table-link>
                                </td>
                                <td class="px-2">{{ $file->expiration }}</td>
                                <td class="px-2">{{ $file->name }}</td>
                                <td class="table-cell text-center font-bold px-2">
                                    {{ $file->attachments_count }} | <span x-text="formData.itemId"></span>
                                </td>
                                <td class="px-2">{{ $file->user->name }}</td>
                                <td class="px-2">
                                    <span x-text="formData.details"
                                        x-show="formData.itemId == '{{ $file->id }}'"></span>
                                </td>
                            </tr>
                        @endforeach
                        <footer>
                            <th colspan="7" class="px-2 border-t border-sky-500"></th>
                        </footer>
                    </table>
                </div>
            </div>
        </div>
        <x-modal-gen name="confirm-file-deletion" maxWidth="md" focusable>
            <form method="post" @submit.prevent="submitForm" action="{{ route('files.destroy', 0) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete resourse?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    <span x-text="itemName"></span>
                </p>

                <div class="mt-2">
                    <x-input-label for="details" :value="__('Details')" />
                    <x-text-input type="text" id="details" name="details" class="block mt-1 w-full"
                        x-model="formData.details" autofocus autocomplete="details" required />
                </div>

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
        function actionFile() {
            return {
                show: @js($errors->fileDeletion->isNotEmpty()),
                itemName: '',
                formAction: '',
                formData: {
                    itemId: 0,
                    details: ''
                },
                open(event) {
                    let itemId = event.target.getAttribute('data-id') == null ?
                        event.target.parentElement.getAttribute('data-id') :
                        event.target.getAttribute('data-id');
                    this.itemName = event.target.getAttribute('data-name') == null ?
                        event.target.parentElement.getAttribute('data-name') :
                        event.target.getAttribute('data-name');

                    this.formData = {
                        itemId: itemId,
                        details: ''
                    };

                    this.formAction = `/file/${this.formData.itemId}`;
                    this.show = true;
                },
                close() {
                    this.show = false;
                    this.itemName = '';
                    this.formAction = '';
                    this.formData = {
                        itemId: 0,
                        details: ''
                    };
                },
                async submitForm() {

                    this.$dispatch('start-loading');

                    try {
                        const response = await axios.delete(this.formAction, {
                            data: this.formData
                        });

                        let row = document.getElementById(`file-row-${response.data.id}`);
                        if (row) {
                            row.remove();
                        }

                        this.close();
                        //this.mensaje = `ERROR: ${response.data.message}`
                    } catch (error) {
                        console.error(error);
                        //this.mensaje = 'Hubo un error al enviar el formulario.';
                    } finally {
                        this.$dispatch('stop-loading');
                    }
                }
            }
        }
    </script>
</x-app-layout>
