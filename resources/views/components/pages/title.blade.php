<div>
    {{ Str::title($title) }}
    <div class="text-sm">V.{{ $version }}</div>
    @if ($published_at)
        <div class="text-sm">{{ $published_at }}</div>
    @endif
</div>
