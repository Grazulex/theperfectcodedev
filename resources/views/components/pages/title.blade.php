<div>
    {{ Str::title($title) }}
    @if ($published_at)
        <div class="text-sm">First publishing {{ $published_at->format('Y-m-d') }}</div>
    @endif
</div>
