<div>
    <h3 class="">Versions</h3>
    <p>Last version V.{{ $pageArray['version'] }}</p>
    @if ($pageArray['stats']['versions_count'] > 0 && $versionArray)
        <p>Showing version V.{{ $versionArray['version'] }}</p>
        @if (Auth::check() && Auth::user()->id === $pageArray['user']['id'])
            @if ($versionsCollection[0]['state'] === \App\Enums\Versions\State::DRAFT)
                <x-action-link href="{{ route('versions.publish', ['page'=>$pageArray['slug'], 'version'=>$versionsCollection[0]['id']]) }}" class="bg-emerald-600">
                    {{ __('Publish this version') }}
                </x-action-link>
            @endif
        @endif
        <h3 class="">History</h3>
        <ul class="">
            @foreach ($versionsCollection as $versionCollectionArray)
                <li>
                    <a href="{{ route('pages.view', ['page'=>$pageArray['slug'], 'version'=>$versionCollectionArray['id']]) }}">
                        V.{{ $versionCollectionArray['version'] }} - {{ $versionCollectionArray['created_at'] }} by {{ $versionCollectionArray['user']['name'] }}
                        @if (Auth::check() && Auth::user()->id === $pageArray['user']['id'])
                            ({{ $versionCollectionArray['state'] }})
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
