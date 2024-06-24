<x-app-layout meta-title="Files | Drive MSPS">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Files') }} [ {{ $files->count() }} ] | <a href="{{ route('files.create') }}">Nuevo</a>
        </h2>
    </x-slot>

    <div class="py-12">
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
                        </tr>
                        {{-- @dump($files) --}}
                        @foreach ($files as $file)
                            <tr>
                                <td class="px-2">{{ $file->id }}</td>
                                <td class="px-2">{{ $file->expiration }}</td>
                                <td class="px-2">{{ $file->name }}</td>
                                <td class="px-2">{{ $file->details_count }}</td>
                                <td class="px-2">{{ $file->user->name }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
