<x-app-layout>
    <x-slot name="header">
        <h2 class="py-4 text-3xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Create a new version for page {{ $page->title }}
        </h2>
    </x-slot>

    <div class="pb-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-[var(--dark)]sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 lg:p-8 dark:bg-[var(--dark)] dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <x-versions.forms.create :page="$page" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
