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
                    <livewire:pages.versions :page-array="$pageArray" :versionArray="$versionArray"/>
                </div>
                <div class="p-2 lg:p-4 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <h4>Description</h4>
                    {!! nl2br(($pageArray['stats']['versions_count'] > 0) ? $versionArray['description'] : $pageArray['description']) !!}
                    <div class="mt-4">
                        <h4>Code</h4>
                        <x-pages.code :code="($pageArray['stats']['versions_count'] > 0) ? $versionArray['code'] : $pageArray['code']"/>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg basic-1/5">
                <div class="p-2 lg:p-4 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <x-users.card :user="$pageArray['user']" :created_at="$pageArray['user']['created_at']" />
                    <div class="inline-flex flex-wrap items-center gap-3 mt-8 group">
                        <livewire:pages.followed :user="$authArray" :page_id="$pageArray['id']" :followers_count="$pageArray['stats']['followers_count']"/>
                        <livewire:pages.like :user="$authArray" :page_id="$pageArray['id']" :likes_count="$pageArray['stats']['likes_count']"/>
                    </div>
                    @if (Auth::check() && Auth::user()->id === $pageArray['user']['id'])
                        <livewire:pages.others :is_public="$pageArray['is_public']"/>
                        <livewire:pages.state :state_name="$pageArray['state']"/>
                    @endif
                    @can('update', $pageArray['id'])
                        <div class="mt-8">
                            <x-action-link href="{{ route('pages.edit', ['page'=>$pageArray['slug']]) }}">
                                {{ __('Edit') }}
                            </x-action-link>
                            @if ($pageArray['state'] === \App\Enums\Pages\State::DRAFT)
                                <x-action-link href="{{ route('pages.publish', ['page'=>$pageArray['slug']]) }}" class="bg-emerald-600">
                                    {{ __('Publish') }}
                                </x-action-link>
                            @endif
                        </div>
                    @else
                        <div class="mt-8">
                            <x-action-link href="{{ route('versions.new', ['page'=>$pageArray['slug']]) }}" class="bg-emerald-600">
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
                        <x-pages.comments :page_id="$pageArray['id']"/>
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>
