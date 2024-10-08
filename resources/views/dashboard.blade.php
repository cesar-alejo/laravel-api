<x-app-layout meta-title="Dashboard | Drive MSPS">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="inline-block text-white font-semibold rounded-lg">
                        <div class="p-4">
                            {{ __("Dashboard | You're logged in!") }}
                        </div>
                        <div class="p-4">
                            @dump(isMobile())
                        </div>
                        <div class="p-4">
                            @dump(session('office_id'))
                            @dump(session('office_code'))
                        </div>
                        <div class="p-4">
                            @dump(auth()->user()->getActiveOffice()->pivot->sign_mech ?? 'Sin Oficina Asignada')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
