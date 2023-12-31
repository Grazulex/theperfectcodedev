<div>
    {{ Str::title($title) }}
    <div class="text-sm">V.{{ $version }}</div>
    @if ($page->state === \App\Enums\Pages\State::PUBLISHED)
        <div class="text-sm">{{ $published_at }}</div>
    @endif
</div>