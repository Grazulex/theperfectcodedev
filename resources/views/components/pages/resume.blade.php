<div class="relative flex flex-col justify-between dark:bg-[var(--dark)] y-between w-full dark:text-[white] text-gray-800 bg-[var(--day-light)] shadow-lg rounded-xl bg-clip-border">
    <div>
        <livewire:pages.tags :tags="$pageArray['tags']"/>
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
    <div class="p-6 pt-3">
        <div class="inline-flex mb-3 flex-wrap items-center gap-3 bg-white group dark:bg-[var(--card-dark)] w-full">
            <div class="flex justify-between w-full border-b border-[#3A445B]">
                <div class="p-2">
                    <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                        <div class="bg-cover bg-no-repeat relative group bg-[url('/resources/images/image.png')] w-[38px] h-[38px]">
                        </div>
                    </button>
                </div>
                <div class="flex self-center">
                    @if (Auth::check())
                        <livewire:pages.followed :user="Auth::user()" :page_id="$pageArray['id']" :followers_count="$pageArray['stats']['followers_count']"/>
                        <livewire:pages.like :user="Auth::user()" :page_id="$pageArray['id']" :likes_count="$pageArray['stats']['likes_count']"/>
                    @else
                        <livewire:pages.followed :user="Null" :page_id="$pageArray['id']" :followers_count="$pageArray['stats']['followers_count']"/>
                        <livewire:pages.like :user="Null" :page_id="$pageArray['id']" :likes_count="$pageArray['stats']['likes_count']"/>
                    @endif
                    <livewire:pages.commented :comments_count="$pageArray['stats']['comments_count']"/>
                    @if (Route::currentRouteName() == 'pages.my')
                        <livewire:pages.others :is_public="$pageArray['is_public']"/>
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
