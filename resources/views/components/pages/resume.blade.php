<div class="relative flex w-full flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
    <div class="p-6">
        <livewire:pages.tags :tags="$page->tags"/>
        <div class="flex items-center justify-between mb-3">
            <h5 class="block font-sans text-xl antialiased font-medium leading-snug tracking-normal text-blue-gray-900">
                <x-pages.title :page="$page" />
            </h5>
        </div>
        <p class="block font-sans text-base antialiased font-light leading-relaxed text-gray-700">
            {{ $page->resume }}
        </p>
        <div class="inline-flex flex-wrap items-center gap-3 mt-8 group">

            <x-users.card :user="$page->user" />

            @if (Auth::check())
                <livewire:pages.like :user="Auth::user()" :page="$page" :likes_count="$page->likes_count"/>
                <livewire:pages.followed :user="Auth::user()" :page="$page" :followers_count="$page->followers_count"/>
            @else
                <livewire:pages.like :user="Null" :page="$page" :likes_count="$page->likes_count"/>
                <livewire:pages.followed :user="Null" :page="$page" :followers_count="$page->followers_count"/>
            @endif
            <livewire:pages.commented :comments_count="$page->comments_count"/>
            @if (Route::currentRouteName() == 'pages.my')
                <livewire:pages.state :page="$page"/>
                <livewire:pages.others :page="$page"/>
            @endif
        </div>
    </div>
    <div class="p-6 pt-3">
        <a href="{{ route('pages.view',['page'=>$page]) }}"
                class="block w-full select-none rounded-lg bg-gray-900 py-3.5 px-7 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button">
            View
        </a>
    </div>
</div>
