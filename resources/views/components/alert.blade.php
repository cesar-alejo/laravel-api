<div class="">

    @session('success')
        <div x-data="{ showSuccess: true }" x-show="showSuccess" class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg"
            x-transition x-init="setTimeout(() => showSuccess = false, 3000)" role="alert">
            <span class="font-medium">¡Éxito!</span> {{ $value }}
        </div>
    @endsession

    @session('error')
        <div x-data="{ showError: true }" x-show="showError" class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg"
            x-transition x-init="setTimeout(() => showError = false, 3000)" role="alert">
            <span class="font-medium">¡Error!</span> {{ $value }}
        </div>
    @endsession
</div>
