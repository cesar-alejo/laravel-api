<x-app-layout meta-title="Create File | Drive MSPS">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm text-red-600 dark:text-red-400 space-y-1">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="expiration" :value="__('Date Expiration')" />
                            <x-text-input id="expiration" class="block mt-1 w-full" type="date" name="expiration"
                                :value="old('expiration')
                                    ? old('expiration')
                                    : \Carbon\Carbon::now()->format('Y-m-d')" required autocomplete="expiration" />
                            <x-input-error :messages="$errors->get('expiration')" class="mt-2" />
                        </div>

                        {{-- <div class="mt-4">
                            <x-input-label for="attachment" :value="__('File')" />
                            <x-text-input id="attachment" class="block mt-1 w-full" type="file" name="attachment" :value="old('attachment')" required autocomplete="none" />
                            <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                        </div> --}}

                        <div class="mt-4">
                            <x-input-label for="details" :value="__('Details')" />
                            <x-textarea id="details" class="block mt-1 w-full" name="details" :value="old('details')"
                                autocomplete="none" placeholder="Detalle de los archivos a compartir" />
                            <x-input-error :messages="$errors->get('details')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Send') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
