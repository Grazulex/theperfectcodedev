<div>
    <div class="flex items-center justify-end mb-3">
        @foreach ($tags as $tag)
            <div class="ml-4 text-xs font-bold leading-sm uppercase px-3 py-1 rounded-full bg-white text-gray-700 border">
                {{ $tag }}
            </div>
        @endforeach
    </div>
</div>
View|Application|Factory|\Illuminate\Contracts\Foundation\Application
