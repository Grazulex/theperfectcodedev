<div>
    @foreach ($comments as $comment)
        <div class="flex flex-col gap-2">
            <x-users.card :user="$comment->user" />
            {{ $comment->created_at->diffForHumans() }}
            {{ $comment->content }}
                @if ($comment->responses_count > 0)
                    <details class="group">
                        <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                            responses
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </span>
                        </summary>
                        <p class="text-neutral-600 mt-3 group-open:animate-fadeIn">
                            <x-pages.comments :page="$comment->page" :level="$comment->id"/>
                        </p>
                    </details>
                @endif
        </div>
    @endforeach
    @if ($level === null)
        {{ $comments->links() }}
    @endif
</div>