<div>
    {{ Str::title($title) }}
    @if ($published_at)
        <div class="text-sm">First publishing {{ $published_at }}</div>
    @endif
</div>
