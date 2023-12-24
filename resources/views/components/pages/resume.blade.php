<div class="relative flex w-full flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
    <div class="p-6">
        <livewire:pages.tags :tags="$page->tags" />
        <div class="flex items-center justify-between mb-3">
            <h5 class="block font-sans text-xl antialiased font-medium leading-snug tracking-normal text-blue-gray-900">
                {{ Str::title($page->title) }}
            </h5>
        </div>
        <p class="block font-sans text-base antialiased font-light leading-relaxed text-gray-700">
            {{ $page->resume }}
        </p>
        <div class="inline-flex flex-wrap items-center gap-3 mt-8 group">
                  <span
                          class="cursor-pointer rounded-full border border-gray-900/5 bg-gray-900/5 p-3 text-gray-900 transition-colors hover:border-gray-900/10 hover:bg-gray-900/10 hover:!opacity-100 group-hover:opacity-70">

                          <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ $page->user->profile_photo_url }}" alt="{{ $page->user->name }}" />
                                    </button>

      </span>
            @if ($page->state === App\Enums\State::PUBLISHED)
                <livewire:pages.published :date="$page->published_at" />
            @endif
            <livewire:pages.like :page="$page" :likes_count="$page->likes_count" />
            <livewire:pages.followed :page="$page" :followers_count="$page->followers_count" />
            <livewire:pages.commented :comments_count="$page->comments_count" />

        </div>
    </div>
    <div class="p-6 pt-3">
        <button
                class="block w-full select-none rounded-lg bg-gray-900 py-3.5 px-7 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button">
            View
        </button>
    </div>
</div>