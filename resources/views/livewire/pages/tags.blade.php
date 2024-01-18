<div>
    <div class="flex pt-6 items-center justify-end mb-3 border-b border-[#3A445B]">
        @foreach ($tags as $tag)
            <div class="mb-5 px-4 py-1 mr-4 text-xs font-bold dark:text-white text-gray-700 uppercase dark:bg-[var(--card-dark)] bg-white rounded-full leading-sm">
                {{ $tag }}
            </div>
        @endforeach
    </div>
</div>
