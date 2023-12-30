<div>
    <div class="flex items-center">
        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
            <img class="h-8 w-8 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
        </button>
        <div class="text-sm">
            <p class="text-gray-900 leading-none">{{ $user->name }}</p>
            <p class="text-gray-600">actif from {{ $user->created_at->diffForHumans() }}</p>
        </div>
    </div>
</div>
