<div>
    <h3 class="">Versions</h3>
    <p>Last version V.{{ $page->version }}</p>
    @if ($page->versions->count() > 0)
        <p>Showing version V.{{ $page->versions->first()->version }}</p>
        @if (Auth::check() && Auth::user()->id === $page->user->id)
            @if ($page->versions->first()->state === \App\Enums\Versions\State::DRAFT)
                <x-action-link href="{{ route('versions.publish', ['page'=>$page, 'version'=>$page->versions->first()]) }}" class="bg-emerald-600">
                    {{ __('Publish this version') }}
                </x-action-link>
            @endif
        @endif
        <h3 class="">History</h3>
        <ul class="">
            @foreach ($listVersions as $version)
                <li>
                    <a href="{{ route('pages.view', ['page'=>$page, 'version'=>$version]) }}">
                        V.{{ $version->version }} - {{ $version->created_at->diffForHumans() }} by {{ $version->user->name }}
                        @if (Auth::check() && Auth::user()->id === $page->user->id)
                            ({{ $version->state }})
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
