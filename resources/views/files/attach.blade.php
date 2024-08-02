<div x-data="{ open: false }">
    @php
        $id = (int) $file->id;
    @endphp
    <div class="p-4">
        <input type="file" class="filepond" name="file" data-url="{{ route('files.upload', ['id' => ':id']) }}"
            multiple>
    </div>

    <script>
        const inputElement = document.querySelector('input[type="file"].filepond');
        let url = inputElement.dataset.url;

        const pond = FilePond.create(inputElement, {
            server: {
                url: url.replace(':id', {{ $id }}),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                }
            },
            acceptedFileTypes: ['image/*', 'pdf'],
            maxFileSize: '5MB',
        });
    </script>
</div>
