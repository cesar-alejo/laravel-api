<div x-data="{ loading: false }" x-on:start-loading.window="loading = true" x-on:stop-loading.window="loading = false">
    <div x-show="loading"
        class="fixed px-4 pt-6 top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center rounded-lg border border-sky-500"
        style="display: none;">
        <div class="loading-spinner ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-2"></div>
        <h2 class="text-center text-white text-xl font-semibold">Cargando...</h2>
        <p class="w-1/3 text-center text-white">Un momento por favor, se esta realizando la consulta.</p>
    </div>
</div>
