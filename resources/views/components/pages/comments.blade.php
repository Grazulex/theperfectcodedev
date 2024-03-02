<div>
    @foreach ($comments as $comment)
        <div class="flex flex-col gap-2">
           <p>Commented {{ $comment['created_at'] }} on V.{{ $comment['version'] }} by {{ $comment['user']['name'] }}</p>
            {{ $comment['content'] }}
                @if (Auth::check())
                    <livewire:comments.like :user="Auth::user()" :is_liked_by_me="$comment['is_liked_by_me']"  :comment_id="$comment['id']" :likes_count="$comment['likes_count']"/>
                @else
                    <livewire:comments.like :user="Null" :is_liked_by_me="$comment['is_liked_by_me']"  :comment_id="$comment['id']" :likes_count="$comment['likes_count']"/>
                @endif
                ({{ $comment['likes_count'] }} likes)
                @if (Auth::check())
                    <button wire:click="response({{ $comment['id'] }})" class="text-neutral-600 hover:text-neutral-800">Response</button>
                @endif
                @if ($comment['responses_count'] > 0)
                    <details class="group">
                        <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                            Responses:
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </span>
                        </summary>
                        <p class="text-neutral-600 mt-3 group-open:animate-fadeIn">
                            <x-pages.comments :page_array="$pageArray" :level="$comment['id']"/>
                        </p>
                    </details>
                @endif
        </div>
    @endforeach
</div>
