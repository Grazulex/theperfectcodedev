<div class="w-full">
    <div class="text-sm">
        <p class="leading-none text-gray-600">{{ $userWithCount->name }}</p>
        <p class="text-gray-600">{{ $userWithCount->created_at->shortRelativeDiffForHumans() }}</p>
    </div>
    <div class="flex-row text-white lg:flex">
        <div class="mr-8">
            <div class="w-[150px] dark:text-white text-black justify-between flex">
                <div>pages: </div>
                <div>{{ $userWithCount->pages_count }}</div>
            </div>
            <div class="w-[150px] dark:text-white text-black justify-between flex">
                <div>comments:</div>
                <div>{{ $userWithCount->comments_count }}</div>
            </div>
        </div>
        <div>
            <div class="w-[150px] dark:text-white text-black justify-between flex">
                <div>followers:</div>
                <div>{{ $userWithCount->followers_count }}</div>
            </div>
            <div class="w-[150px] dark:text-white text-black justify-between flex">
                <div>likes:</div>
                <div>{{ $userWithCount->likes_count }}</div>
            </div>
        </div>
    </div>
</div>
