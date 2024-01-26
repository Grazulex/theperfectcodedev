<div>
    <div class="flex items-center justify-end pt-6">
        @foreach ($tags as $tag)
            <div class="mb-5 px-4 py-1 ml-4 text-xs font-bold dark:text-white text-gray-700 uppercase dark:bg-[var(--card-dark)] bg-white rounded-full leading-sm">
                {{ $tag }}
            </div>
        @endforeach
    </div>
</div>
