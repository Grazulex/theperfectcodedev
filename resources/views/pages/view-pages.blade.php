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
        <div class="grid md:grid-cols-4 rid-cols-1">
            <div class="bg-white md:col-span-3 sm:rounded-lg dark:bg-gray-800">
                <div class="md:flex border-b p-5 border-[#3A445B] justify-between">
                    <h2 class="self-center gap-3 text-xl font-semibold leading-tight text-gray-800 align-middle dark:text-gray-200">
                        <x-pages.title :title="$pageArray['title']"/>
                    </h2>
                    <div>
                        <livewire:pages.tags :tags="$pageArray['tags']"/>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="pt-4 mb-5 text-lg font-bold text-gray-800 dark:text-gray-200">
                        {{ $pageArray['resume'] }}
                    </h3>
                    <livewire:pages.versions :page-array="$pageArray" :versionArray="$versionArray"/>
                </div>
            </div>

            <div class="md:pl-5">
                <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg md:basic-1/5">
                    <div class="flex justify-between w-full border-b border-[#3A445B]">
                        <div class="flex">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex p-2 text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                    <img class="object-cover w-8 h-8 rounded-full" src="{{ $pageArray['user']['profile_photo_url'] }}" alt="{{ $pageArray['user']['name'] }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700">
                                            {{ $pageArray['user']['name'] }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                            @endif
                            <div class="self-center">
                                <x-label class="truncate max-w-[100px] dark:text-[white] text-gray-800" for="name" value="{{ $pageArray['user']['name'] }}" />
                                @if (Auth::check() && Auth::user()->id === $pageArray['user']['id'])
                                    <livewire:pages.others :is_public="$pageArray['is_public']"/>
                                @endif
                            </div>
                        </div>
                        <div class="flex self-center">
                            @if (Auth::check() && Auth::user()->id === $pageArray['user']['id'])
                                <livewire:pages.state :state_name="$pageArray['state']"/>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                        <x-users.card :user="$pageArray['user']" :created_at="$pageArray['user']['created_at']" />
                        <div class="p-3 border-t border-gray-700">
                            @if($canUpdate)
                                <div>
                                    <x-action-link href="{{ route('pages.edit', ['page'=>$pageArray['slug']]) }}">
                                        {{ __('Edit') }}
                                    </x-action-link>
                                    @if ($pageArray['state'] === \App\Enums\Pages\State::DRAFT->value)
                                        <x-action-link href="{{ route('pages.publish', ['page'=>$pageArray['slug']]) }}">
                                            {{ __('Publish') }}
                                        </x-action-link>
                                    @endif
                                </div>
                            @else
                                <div>
                                    <x-action-link href="{{ route('versions.new', ['page'=>$pageArray['slug']]) }}">
                                        {{ __('New version') }}
                                    </x-action-link>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden text-gray-800 bg-white shadow-xl dark:text-gray-200 dark:bg-[var(--dark)] sm:rounded-lg basic-4/5">
                <div class="p-2 bg-white border-b border-gray-200 lg:p-4 dark:bg-gradient-to-bl dark:bg-[var(--dark)] dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <h4>Description</h4>
                    {!! nl2br(($pageArray['stats']['versions_count'] > 0 && $versionArray) ? $versionArray['description'] : $pageArray['description']) !!}
                    <div class="mt-4">
                        <h4>Code</h4>
                        <x-pages.code :code="($pageArray['stats']['versions_count'] > 0 && $versionArray) ? $versionArray['code'] : $pageArray['code']"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto text-gray-800 dark:text-gray-200 max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-[var(--dark)] sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 lg:p-8 dark:bg-[var(--dark)] dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent dark:border-gray-700">
                    <h4>Comments</h4>
                    <div class="mt-4">
                        <x-pages.comments :page_array="$pageArray"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
