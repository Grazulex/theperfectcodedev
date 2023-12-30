<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex gap-3 align-middle">
            {{ $page->title }} <div class="text-sm">V.{{ $page->version }}</div>
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
                        <div class="prose lg:prose-l max-w-none mb-8">
                            {!! Str::markdown($page->code) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg basic-1/5">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <x-users.card :user="$page->user" />
                    <div class="inline-flex flex-wrap items-center gap-3 mt-8 group">
                        @if ($page->state === \App\Enums\Pages\State::PUBLISHED)
                            <livewire:pages.published :date="$page->published_at"/>
                        @endif
                        @if (Auth::check())
                            <livewire:pages.like :user="Auth::user()" :page="$page" :likes_count="$page->likes_count"/>
                            <livewire:pages.followed :user="Auth::user()" :page="$page" :followers_count="$page->followers_count"/>
                        @else
                            <livewire:pages.like :user="Null" :page="$page" :likes_count="$page->likes_count"/>
                            <livewire:pages.followed :user="Null" :page="$page" :followers_count="$page->followers_count"/>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <h4>Comments</h4>
                    <div class="mt-4">
                        @foreach ($page->comments as $comment)
                            <div class="flex flex-col gap-2">
                                {{ $comment->content }}
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>
