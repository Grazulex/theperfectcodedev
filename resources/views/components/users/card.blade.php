<div class="w-full p-3">
    <div class="text-sm">
        <p class="leading-none text-gray-600">{{ $user['name'] }}</p>
        <p class="text-gray-600">{{ $created_at->format('Y-m-d') }}</p>
    </div>
    <div class="flex-row text-white lg:flex">
        <div class="mr-8">
            <div class="w-[150px] dark:text-white text-black justify-between flex">
                <div>pages: </div>
                <div>{{ $user['stats']['pages_count'] }}</div>
            </div>
            <div class="w-[150px] dark:text-white text-black justify-between flex">
                <div>comments:</div>
                <div>{{ $user['stats']['comments_count'] }}</div>
            </div>
        </div>
        <div>
            <div class="w-[150px] dark:text-white text-black justify-between flex">
                <div>followers:</div>
                <div>{{ $user['stats']['followers_count'] }}</div>
            </div>
            <div class="w-[150px] dark:text-white text-black justify-between flex">
                <div>likes:</div>
                <div>{{ $user['stats']['likes_count'] }}</div>
            </div>
        </div>
    </div>
</div>
