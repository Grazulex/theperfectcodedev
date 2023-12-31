<div>
    <div class="items-center">
        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
            <img class="h-8 w-8 rounded-full object-cover" src="{{ $userWithCount->profile_photo_url }}" alt="{{ $userWithCount->name }}" />
        </button>
        <div class="text-sm">
            <p class="text-gray-900 leading-none">{{ $userWithCount->name }}</p>
            <p class="text-gray-600">{{ $userWithCount->created_at->shortRelativeDiffForHumans() }}</p>
        </div>
        <div class="text-xs">
            <p class="text-gray-600">{{ $userWithCount->pages_count }} pages</p>
            <p class="text-gray-600">{{ $userWithCount->comments_count }} comments</p>
            <p class="text-gray-600">{{ $userWithCount->followers_count }} followers</p>
            <p class="text-gray-600">{{ $userWithCount->likes_count }} likes</p>
        </div>
    </div>
</div>
