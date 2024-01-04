<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex gap-3 align-middle">
            <x-pages.title :page="$page"/>
        </h2>
        <h3 class="pt-4 text-lg font-bold mb-5">
            {{ $page->resume }}
        </h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-row"><p>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg basic-4/5">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <h4>Description</h4>
                    {!! nl2br($page->description) !!}
                    <div class="mt-4">
                        <h4>Code</h4>
                        <x-pages.code :code="$page->code"/>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg basic-1/5">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <x-users.card :user="$page->user" />
                    <div class="inline-flex flex-wrap items-center gap-3 mt-8 group">
                        <livewire:pages.like :user="$authUser" :page="$page" :likes_count="$page->likes_count"/>
                        <livewire:pages.followed :user="$authUser" :page="$page" :followers_count="$page->followers_count"/>
                    </div>
                    @can('update', $page)
                        <div class="mt-8">
                            <x-action-link href="{{ route('pages.edit', ['page'=>$page]) }}">
                                {{ __('Edit') }}
                            </x-action-link>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <h4>Comments</h4>
                    <div class="mt-4">
                        <x-pages.comments :page="$page"/>
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>
