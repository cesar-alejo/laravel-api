<div x-data="{ open: false }">
    <div class="p-4">

        <input type="file" class="filepond" name="file"
            data-url="{{ route('attachments.attach', ['model' => 'files', 'id' => ':id']) }}" multiple>
    </div>
    <x-filepoint :id="$file->id" model="files"></x-filepoint>
</div>
