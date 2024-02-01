<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Create a new code
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 bg-[#F0F7F8] border-b border-gray-200 lg:p-8 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <x-pages.forms.create />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
