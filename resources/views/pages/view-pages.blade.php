<x-app-layout>
    <x-slot name="meta">
        <meta name="description" content="{{ $pageArray['resume'] }}">
        <meta name="keywords" content="{{ implode(",", $pageArray['tags']) }}">
        <meta property="og:title" content="{{ $pageArray['title'] }}">
        <meta property="og:description" content="{{ $pageArray['resume'] }}">
        <meta property="og:url" content="{{ route('pages.view', ['page'=>$pageArray['slug']]) }}">
        <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">
        <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
        <meta property="og:type" content="article">
        <meta property="article:published_time" content="{{ $pageArray['created_at'] }}">
        <meta property="article:modified_time" content="{{ $pageArray['updated_at'] }}">
        <meta property="article:author" content="{{ $pageArray['user']['name'] }}">
        <meta property="article:section" content="{{ implode(",", $pageArray['tags']) }}">
        <meta property="article:tag" content="{{ implode(",", $pageArray['tags']) }}">
        <meta property="twitter:title" content="{{ $pageArray['title'] }}">
        <meta property="twitter:description" content="{{ $pageArray['resume'] }}">
        <meta property="twitter:url" content="{{ route('pages.view', ['page'=>$pageArray['slug']]) }}">
        <meta property="twitter:site" content="{{ config('app.name', 'Laravel') }}">
        <meta property="twitter:creator" content="{{ $pageArray['user']['name'] }}">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex gap-3 align-middle">
            <x-pages.title :title="$pageArray['title']"/>
        </h2>
        <h3 class="pt-4 text-lg font-bold mb-5">
            {{ $pageArray['resume'] }}
        </h3>
        <div class="pt-4 text-lg font-bold mb-5">
            <livewire:pages.tags :tags="$pageArray['tags']"/>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-row"><p>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg basic-4/5">
                <div class="p-2 lg:p-4 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <livewire:pages.versions :page-array="$pageArray"/>
                </div>
                <div class="p-2 lg:p-4 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <h4>Description</h4>
                    {!! nl2br(($pageArray['stats']['versions_count'] > 0) ? $page->versions->first()->description : $page->description) !!}
                    <div class="mt-4">
                        <h4>Code</h4>
                        <x-pages.code :code="($pageArray['stats']['versions_count'] > 0) ? $page->versions->first()->code : $page->code"/>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg basic-1/5">
                <div class="p-2 lg:p-4 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <x-users.card :user="$page->user" />
                    <div class="inline-flex flex-wrap items-center gap-3 mt-8 group">
                        <livewire:pages.like :user="$authUser" :page="$page" :likes_count="$page->likes_count"/>
                        <livewire:pages.followed :user="$authUser" :page="$page" :followers_count="$page->followers_count"/>
                    </div>
                    @if (Auth::check() && Auth::user()->id === $page->user->id)
                        <livewire:pages.state :page="$page"/>
                        <livewire:pages.others :page="$page"/>
                    @endif
                    @can('update', $page)
                        <div class="mt-8">
                            <x-action-link href="{{ route('pages.edit', ['page'=>$page]) }}">
                                {{ __('Edit') }}
                            </x-action-link>
                            @if ($page->state === \App\Enums\Pages\State::DRAFT)
                                <x-action-link href="{{ route('pages.publish', ['page'=>$page]) }}" class="bg-emerald-600">
                                    {{ __('Publish') }}
                                </x-action-link>
                            @endif
                        </div>
                    @else
                        <div class="mt-8">
                            <x-action-link href="{{ route('versions.new', ['page'=>$page]) }}" class="bg-emerald-600">
                                {{ __('New version') }}
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
                        <x-pages.comments :page="$pageArray"/>
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>
