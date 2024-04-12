<div>
    @if (Auth::check())
        <div class="">
            <livewire:comments.form :user="Auth::user()" :comment_id="$commentId"  :page_id="$page_id" :version_id="$version_id" />
        </div>
    @endif
    @foreach ($comments as $comment)
        @if ($comment['content'] )
            <div class="flex flex-col gap-2 mt-4 mb-4 {{ $comment['parent'] ? 'ml-3' : 'border-[#3A445B]  border-b' }}">

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
                </div>

                <x-pages.comments :page_array="$pageArray" :versionArray="$versionArray" :comment_id="$comment['id']" />
            </div>

        @endif
    @endforeach
    @if (count($comments) > 1)
        <div class="flex justify-center">
            {{ $comments->links() }}
        </div>
     @endif
</div>
