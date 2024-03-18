<div>
    @if (Auth::check())
        <livewire:comments.form :user="Auth::user()" :comment_id="$commentId"  :page_id="$page_id" :version_id="$version_id" />
    @endif
    @foreach ($comments as $comment)
        <div class="flex flex-col gap-2 mt-4 mb-4 ">
            <div class="flex">
                <p class="text-lg">{{ $comment['user']['name'] }}:</p>
                <p class="self-center ml-2 text-sm text-gray-400">{{ $comment['created_at'] }} on V.{{ $comment['version_id'] }}</p>
            </div>
            <div class="text-lg">
                {{ $comment['content'] }}
            </div>
            <div class="flex">
                @if (Auth::check())
                    <livewire:comments.like :user="Auth::user()" :is_liked_by_me="$comment['is_liked_by_me']"  :comment_id="$comment['id']" :likes_count="$comment['likes_count']"/>
                @else
                    <livewire:comments.like :user="Null" :is_liked_by_me="$comment['is_liked_by_me']"  :comment_id="$comment['id']" :likes_count="$comment['likes_count']"/>
                @endif
                ({{ $comment['likes_count'] }} likes)
            </div>

            @if ($comment['content'])
                <x-pages.comments :page_array="$pageArray" :versionArray="$versionArray" :comment_id="$comment['id']"   :level="$comment['id']"/>
            @endif
        </div>
    @endforeach

    <div class="flex justify-center">
        {{ $comments->links() }}
    </div>
</div>
