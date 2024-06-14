<x-layout :meta-title="'File: ' . $file->name">
    <div>
        <h1>File {{ $file->id }}</h1>
        @dump($file)
    </div>
</x-layout>
