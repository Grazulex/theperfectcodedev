<div class="relative flex flex-col justify-between dark:bg-[var(--dark)] y-between w-full dark:text-[white] text-gray-800 bg-[var(--day-light)] shadow-lg rounded-xl bg-clip-border">
    <div>
        <div class="border-b border-[#3A445B] pr-5 mb-5">
            <livewire:pages.tags :tags="$pageArray['tags']"/>
        </div>
        <div class="pl-5 pr-5">
            <div class="flex items-center justify-between mb-3">
                <h5 class="block text-xl antialiased font-medium leading-snug tracking-normal text-blue-gray-900">
                    <x-pages.title :title="$pageArray['title']" :published_at="$pageArray['published_at']" />
                </h5>
                v.{{ $pageArray['version'] }}
            </div>
            <p class="block text-base antialiased font-light leading-relaxed">
                {{ $pageArray['resume'] }}
            </p>
        </div>
    </div>
    <div class="p-5 pt-3">
        <div class="inline-flex mb-3 flex-wrap items-center gap-3 bg-white group dark:bg-[var(--card-dark)] w-full">
            <div class="flex justify-between w-full border-b border-[#3A445B]">
                <div class="flex">
                    <button class="flex p-2 text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                        <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </button>
                    <div class="self-center">
                        <x-label  class="dark:text-[white] text-[16px] text-gray-800" for="name" value="{{ __('Jean-marc Strauven') }}" />
                        <livewire:pages.others :is_public="$pageArray['is_public']"/>
                    </div>
                </div>
                <div class="flex self-center">
                    @if (Auth::check())
                        <livewire:pages.followed :user="Auth::user()" :is_followed_by_me="$pageArray['is_followed_by_me']" :page_id="$pageArray['id']" :followers_count="$pageArray['stats']['followers_count']"/>
                        <livewire:pages.like :user="Auth::user()" :is_liked_by_me="$pageArray['is_liked_by_me']"  :page_id="$pageArray['id']" :likes_count="$pageArray['stats']['likes_count']"/>
                    @else
                        <livewire:pages.followed :user="Null" :is_followed_by_me="$pageArray['is_followed_by_me']"  :page_id="$pageArray['id']" :followers_count="$pageArray['stats']['followers_count']"/>
                        <livewire:pages.like :user="Null" :is_liked_by_me="$pageArray['is_liked_by_me']"  :page_id="$pageArray['id']" :likes_count="$pageArray['stats']['likes_count']"/>
                    @endif
                    <livewire:pages.commented :comments_count="$pageArray['stats']['comments_count']"/>
                    @if (Route::currentRouteName() == 'pages.my')
                        <!-- <livewire:pages.others :is_public="$pageArray['is_public']"/> -->
                        <livewire:pages.state :state_name="$pageArray['state']"/>
                    @endif
                </div>
            </div>

            <x-users.card :user="$pageArray['user']" :created_at="$pageArray['user']['created_at']" />
        </div>
        <a href="{{ route('pages.view',['page'=>$pageArray['slug']]) }}"
                class="block w-full select-none rounded-lg bg-[var(--primary)]  py-3.5 px-7 text-center align-middle text-sm font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button">
            View
        </a>
    </div>
</div>
