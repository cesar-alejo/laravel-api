@props(['name'])

<div x-data="modalSubMod()">
    <div x-data="{
        focusables() {
                let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
                return [...$el.querySelectorAll(selector)]
                    .filter(el => !el.hasAttribute('disabled'))
            },
            firstFocusable() { return this.focusables()[0] },
            lastFocusable() { return this.focusables().slice(-1)[0] },
            nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
            prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
            nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
            prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1 },
    
    }" x-init="$watch('isOpen', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })"
        x-on:open-modal.window="$event.detail.name == '{{ $name }}' ? open($event.detail) : null"
        x-on:close-modal.window="$event.detail == '{{ $name }}' ? isOpen = false : null"
        x-on:close.stop="isOpen = false" x-on:keydown.escape.window="isOpen = false"
        x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
        x-on:keydown.shift.tab.prevent="prevFocusable().focus()" x-show="isOpen"
        class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-40" style="display:none;">
        <div x-show="isOpen" class="fixed inset-0 transform transition-all" x-on:click="isOpen = false"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        </div>

        <div x-show="isOpen"
            class="p-2 mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-3xl sm:mx-auto"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

            <div class="flex items-center justify-between p-2 border-b dark:border-gray-600">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" x-text="title"></h3>

                <button type="button" @click="close"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div
                class="flex p-1 border-b dark:border-gray-600 text-base leading-relaxed text-gray-500 dark:text-gray-400">
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <template x-for="link in main" key="link.text">
                        <a href="#" x-on:click.prevent="fetchData(link)" x-text="link.text"
                            x-bind:class="{
                                'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out': active ===
                                    link.text,
                                'inline-flex items-center px-1 pt-1 border-b-2 border-transparent leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out': active !==
                                    link.text,
                            }">
                        </a>
                    </template>
                </div>
            </div>

            <div class="p-1 space-y-4 text-base leading-relaxed text-gray-500 dark:text-gray-400">
                <div x-html="content"></div>
            </div>
        </div>
    </div>
</div>
