<div x-data="{ open: false }">
    <div class="p-4">
        <input type="file" class="filepond" name="file" data-url="{{ route('files.upload', ['id' => ':id']) }}"
            multiple>
    </div>

    <script>
        const inputElement = document.querySelector('input[type="file"].filepond');
        let url = inputElement.dataset.url;

        FilePond.create(inputElement, {
            server: {
                url: url.replace(':id', {{ (int) $file->id }}),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                }
            },
            acceptedFileTypes: ['image/*', 'application/pdf', 'text/csv', 'application/zip',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.oasis.opendocument.spreadsheet'
            ],
            labelFileTypeNotAllowed: 'Tipoo de archivo inválido',
            fileValidateTypeLabelExpectedTypes: 'Se espera {allButLastType} o {lastType}',
            maxFileSize: '15MB',
            labelMaxFileSizeExceeded: 'El archivo es demasiado grande',
            labelMaxFileSize: 'El tamaño máximo de archivo es {filesize}',
        });

        FilePond.setOptions({
            labelIdle: 'Arrastra y suelta tus archivos o <span class="filepond--label-action"> Navega </span>',
            labelInvalidField: 'El campo contiene archivos inválidos',
            labelFileWaitingForSize: 'Esperando tamaño',
            labelFileSizeNotAvailable: 'Tamaño no disponible',
            labelFileLoading: 'Cargando',
            labelFileLoadError: 'Error durante la carga',
            labelFileProcessing: 'Subiendo',
            labelFileProcessingComplete: 'Subida completada',
            labelFileProcessingAborted: 'Subida cancelada',
            labelFileProcessingError: 'Error durante la subida',
            labelFileProcessingRevertError: 'Error durante la reversión',
            labelFileRemoveError: 'Error durante la eliminación',
            labelTapToCancel: 'toca para cancelar',
            labelTapToRetry: 'toca para reintentar',
            labelTapToUndo: 'toca para deshacer',
        });
    </script>
</div>
