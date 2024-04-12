<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Your codes
        </h2>
    </x-slot>

    <div class="pb-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 lg:p-8 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                        @foreach ($pagesCollection['data'] as $pageArray)
                            <x-pages.resume :page-array="$pageArray" />
                        @endforeach
                    </div>
                    <a  href="{{ url('code/new') }}"
                            class=" mt-4 block w-full select-none rounded-lg bg-[var(--primary)]  py-3 px-7 text-center align-middle text-sm font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                        create my code
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
